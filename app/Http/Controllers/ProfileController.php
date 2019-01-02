<?php

namespace App\Http\Controllers;

use App\ClassAttendee;
use App\Events\ListKelasSayaEvent;
use App\Events\UpdateLmsUserDataEvent;
use App\Events\ReferralEmailEvent;
use App\Http\Requests;
use App\Order;
use App\Product;
use App\RatingReview;
use App\Services\Firebase;
use App\Services\Lms;
use App\User;
use App\UserParticipant;
use Auth;
use Cache;
use DB;
use PDF;
use Illuminate\Http\Request;
use Session;
use Storage;
use App\Category;

class ProfileController extends Controller
{
    protected $new_view = 'pintaria3.profiles';

    public function index()
    {
        $user = User::findOrFail(Auth::user()->id);
        $user_referral_code = $user->default_referral_code->first();
        return view($this->new_view . '.index', compact('user', 'user_referral_code'));
    }

    public function edit()
    {
        $user = User::findOrFail(Auth::user()->id);
        return view($this->new_view . '.edit', compact('user'));
    }

    public function editPassword(){
        $user = User::findOrFail(Auth::user()->id);
        return view($this->new_view . '.edit-password', compact('user'));
    }

    public function update(Requests\UpdateAkunSayaRequest $request)
    {
        $data = $request->all();
        $user = Auth::user();

        $pp_object = $pp = null;
        if(isset($data['profile_picture']) && !empty($data['profile_picture'])) {
            $pp_object = $data['profile_picture'];
            $user_id = $user->provider_id ? $user->provider_id : $user->id;
            $data['profile_picture'] = 'users/' . $user_id .'/profile_picture_object_'. $pp_object->getClientOriginalName();
            $pp = $data['profile_picture'];
            Storage::disk('lmsums_gcs')->put($data['profile_picture'], file_get_contents($pp_object));
        }

        event(new UpdateLmsUserDataEvent($user->provider_id, $data['name'], $data['phone_number'], $pp, $data['address'], $data['home_number']));

        $update = User::where('id', $user->id)->update([
            'name' => $data['name'],
            'home_number' => $data['home_number'],
            'phone_number' => $data['phone_number'],
            'address' => $data['address'],
            'profile_picture' => (isset($data['profile_picture']) && !empty($data['profile_picture'])) ? $data['profile_picture']: $user->profile_picture,
        ]);

        if($update) {
            return response()->json([], 204);
        }
        return response()->json(['message' => 'Maaf, saat ini kami belum bisa memproses request Anda.'], 500);
    }

    public function updatePassword(Requests\UpdatePasswordSayaRequest $request) {
        $data = $request->all();
        if (!empty($data['password'])){
            $firebase = new Firebase();
            $updatePassword = $firebase->updatePassword(Auth::user()->email,$data['password'],$data['new_password']);
            if ( !empty($updatePassword['status']) && $updatePassword['status'] == 400){
                return response()->json(['message' => $updatePassword['message']], 400);
            }
        }

        if($updatePassword) {
            return response()->json([], 204);
        }
        return response()->json(['message' => 'Maaf, saat ini kami belum bisa memproses request Anda.'], 500);
    }

    /**
    * User->provider_id is the id on LMSUMS database on table users
    */
    public function kelasSaya(Request $request)
    {
        $data = $request->all();
        $user = Auth::user();

        $categories = Category::all();
        $courses = Product::userCourses($user, $data);

        $cache_key = 'event_list_kelas_saya_user_'.$user->id;
        $event_triggered = cache($cache_key, 0);
        if($event_triggered < 3) {
            if($event_triggered == 0) {
                Cache::forever($cache_key, 1);
            }
            Cache::increment($cache_key, 1);
            event(new ListKelasSayaEvent($user));
        }
        return view($this->new_view . '.classes', compact('courses', 'categories'));
    }

    public function myTransaction(Request $request) {
        $filter = $request->get('filter');
        $default_filter = Order::CONVERTED_STATUS_PENDING;

        $orders = Order::getMyTransaction(Auth::user(), $filter);
        $order_status_list = Order::getOrderStatusList();
        return view($this->new_view . '.my-transaction', compact('orders', 'order_status_list', 'default_filter'));
    }

    public function review($slug) {
        $user = auth()->user();
        $product = ClassAttendee::join('products AS p', function($query) use ($user, $slug) {
                            $query->on('p.slug', '=', 'class_attendees.slug');
                        })
                        ->leftJoin('rating_reviews AS rr', function($query) use ($user) {
                            $query->on('rr.product_id', '=', 'p.id')
                                ->where('rr.reviewer_email', '=', $user->email)
                                ->whereIn('rr.status', RatingReview::STATUS_CANNOT_REVIEW);
                        })
                        ->where('class_attendees.user_id', '=', $user->id)
                        ->where('class_attendees.slug', '=', $slug)
                        ->where('class_attendees.attendance_completion_percentage', '>=', RatingReview::MINIMUM_COURSE_COMPLETION_TO_RATE)
                        ->select(['p.id', 'p.name', 'p.image', 'p.slug', 'p.is_review_shown', 'rr.id AS rating_review_id',])
                        ->firstOrFail();

        if (!$product->is_review_shown) {
            return abort(404);
        }

        if($product->rating_review_id) {
            return abort(404);
        }

        $providers = DB::table('providers as p')
                                ->join('product_provider as pp', function ($query) {
                                    $query->on('pp.provider_id', '=', 'p.id');
                                })
                                ->where('pp.product_id', $product->id)
                                ->select(['p.name'])
                                ->get();
        $product->provider_list = implode(',', $providers->pluck('name')->toArray());
        $product->route_url = route('product.index', [$slug]);
        $product->image_full_url = image_full_path($product->image);

        return view($this->new_view . '.review', compact('product'));
    }

    public function submitReview(Requests\CreateReviewRequest $request, $slug) {
        $data = $request->all();
        $user = auth()->user();

        $response = [
            'status' => 400,
            'message' => 'Kami sedang kesulitan memproses ulasan Anda.',
        ];

        $product = Product::join('class_attendees AS ca', function($query) use($user) {
                        $query->on('ca.slug', '=', 'products.slug')
                            ->where('ca.user_id', '=', $user->id)
                            ->where('ca.attendance_completion_percentage', '>=', RatingReview::MINIMUM_COURSE_COMPLETION_TO_RATE);
                    })
                    ->leftJoin('rating_reviews AS rr', function($query) use($user) {
                        $query->on('rr.product_id', '=', 'products.id')
                            ->where('rr.reviewer_email', '=', $user->email)
                            ->whereIn('rr.status', RatingReview::STATUS_CANNOT_REVIEW);
                    })
                    ->where('products.slug', $slug)
                    ->select(['products.id', 'products.is_review_shown', 'rr.id AS rating_review_id',])
                    ->first();

        if(!$product) {
            $response['message'] = 'Produk yang akan Anda ulas tidak tersedia';
            return response()->json($response);
        }

        if(!$product->is_review_shown) {
            $response['message'] = 'Maaf, anda belum dapat mengirim ulasan untuk produk ini.';
            return response()->json($response);
        }
        
        if($product->rating_review_id) {
            $response['message'] = 'Maaf, anda belum dapat mengirim ulasan untuk produk ini.';
            return response()->json($response);
        }

        $submit_review = RatingReview::create([
                        'reviewer_name' => $user->name,
                        'reviewer_email' => $user->email,
                        'product_id' => $product->id,
                        'review' => $data['review'],
                        'rating' => (int) $data['rating'],
                        'status' => RatingReview::STATUS_PENDING,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ]);

        if($submit_review) {
            $response['status'] = 200;
            $response['message'] = 'Terima kasih untuk ulasan Anda. Ulasan Anda akan melalui proses moderasi oleh Administrator kami.';
        }

        return response()->json($response);
    }

    public function recommendFriends()
    {
        $user = User::findOrFail(Auth::user()->id);
        $user_referral_code = $user->default_referral_code->first();
        if (!$user_referral_code) return abort(404);
        return view($this->new_view . '.recommend-friends', compact('user', 'user_referral_code'));
    }

    public function sendReferralEmail(Requests\SendReferralRequest $request)
    {
        $data = $request->all();
        $response = [
            'status' => 200,
            'message' => 'Selamat! Kamu baru saja membagikan kode referralmu. Kumpulkan poinnya dan menangkan hadiahnya!',
        ];
        event(new ReferralEmailEvent($data));
        return response()->json($response);
    }

    public function streamAttendeeCard($slug)
    {
        $data = [];
        $user = auth()->user();

        $class_attendee = ClassAttendee::userCoursesBySlug($user->id, $slug)->firstOrFail();
        $product = $class_attendee->product;

        if(!$product){
            return abort(404);
        }

        $participants = UserParticipant::productUserParticipant($user->id, $product->id)->get();

        foreach ($participants as $participant) {
            $data[] = [
                'name' => $participant->name,
                'attendee_card_id' => $participant->card_id,
                'course' => $product->name,
                'date' => date('d/m/Y', strtotime($product->course_start_at)),
                'time' => date('H:i', strtotime($product->course_start_at)) . ' - ' . date('H:i', strtotime($product->course_end_at)) . ' WIB',
            ];
        }

        return PDF::loadView($this->new_view . '.attendee_card_template', ['attendees' => $data])
            ->setPaper('comm10e')
            ->setOrientation('landscape')
            ->setOption('margin-bottom', 0)
            ->setOption('margin-top', 0)
            ->setOption('margin-left', 0)
            ->setOption('margin-right', 0)
            ->inline('kartu-peserta-' . $slug . '.pdf');
    }
}
