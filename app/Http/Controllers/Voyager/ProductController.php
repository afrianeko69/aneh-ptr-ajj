<?php

namespace App\Http\Controllers\Voyager;

use App\Instructor;
use App\Product;
use App\Provider;
use App\Services\Lms;
use App\Traits\AttendeeCard;
use Carbon\Carbon;
use PDF;
use Storage;

class ProductController extends Controller
{
    public function insertUpdateData($request, $slug, $rows, $data) {
        $form_data = $request->except('_token', '_method');
        $multiple_data = [
            'category', 'industries', 'topics', 'providers', 'provider_sort',
            'instructors', 'instructor_showed', 'instructor_sort', 'professions',
            'product_tryout_button', 'product_tryout_embed_link', 'product_tryout_id',
            'product_tryout_sort', 'user_participant_discounts', 'participant_prices', 'participant_is_same_providers',
            'participant_discount_start_ats', 'participant_discount_end_ats', 'related_review_products',
        ];
        $dates = [
            'discount_start_at',
            'discount_end_at',
            'show_start_at',
            'show_end_at',
            'course_start_at',
            'course_end_at',
        ];

        foreach($form_data as $index => $form) {
            if(!in_array($index, $multiple_data)) {
                if(in_array($index, $dates)) {
                    $data->{$index} = (!empty($form) ? Carbon::parse($form) : null);
                } else {
                    $data->{$index} = $form;
                }
            }
        }

        $images = ['image', 'banner'];
        foreach($images as $k) {
            $image_path = $this->processImage($request, $slug, $k);
            if($image_path) {
                $data->{$k} = $image_path;
            }
        }

        $data->save();

        if($form_data['is_tryout']) {
            $tryout_ids = [];
            if(isset($form_data['product_tryout_id'])) {
                foreach($form_data['product_tryout_id'] as  $key => $id) {
                    $data->tryouts()->where('id', $id)->update([
                        'button_name' => $form_data['product_tryout_button'][$key],
                        'embed_link' => $form_data['product_tryout_embed_link'][$key],
                        'sort' => $form_data['product_tryout_sort'][$key],
                    ]);

                    unset($form_data['product_tryout_button'][$key]);
                    unset($form_data['product_tryout_embed_link'][$key]);
                    unset($form_data['product_tryout_sort'][$key]);
                    array_push($tryout_ids, $id);
                }
            }

            if($tryout_ids || $request->_method == 'PUT') {
                $data->tryouts()->whereNotIn('id', $tryout_ids)->delete();
            }

            if(isset($form_data['product_tryout_button'])) {
                foreach($form_data['product_tryout_button'] as $key => $tryout) {
                    if(!$tryout || !$form_data['product_tryout_embed_link'][$key] || !$form_data['product_tryout_sort'][$key]) {
                        continue;
                    }

                    $data->tryouts()->create([
                        'button_name' => $tryout,
                        'embed_link' => $form_data['product_tryout_embed_link'][$key],
                        'sort' => $form_data['product_tryout_sort'][$key],
                    ]);
                }
            }
        } else {
            $data->tryouts()->delete();
        }

        $multiple_data = [
            'category' => [],
            'industries' => [],
            'topics' => [],
            'providers' => [],
            'instructors' => [],
            'professions' => [],
            'user_participant_discounts' => [],
            'related_review_products' => [],
        ];

        foreach($multiple_data as $key => $option) {
            if(isset($form_data[$key])) {
                switch ($key) {
                    case 'providers':
                        foreach($form_data[$key] as $k => $i) {
                            if(!empty($i)) {
                                $multiple_data[$key][$i] = [
                                    'sort' => (!empty($form_data['provider_sort'][$k]) ? $form_data['provider_sort'][$k] : null),
                                ];
                            }
                        }
                        $data->{$key}()->sync($multiple_data[$key]);
                        break;
                    case 'instructors':
                        foreach($form_data[$key] as $k => $i) {
                            if(!empty($i)) {
                                $multiple_data[$key][$i] = [
                                    'sort' => (!empty($form_data['instructor_sort'][$k]) ? $form_data['instructor_sort'][$k] : null),
                                    'is_showed' => (isset($form_data['instructor_showed'][$k]) ? $form_data['instructor_showed'][$k] : null),
                                ];
                            }
                        }
                        $data->{$key}()->sync($multiple_data[$key]);
                        break;
                    case 'user_participant_discounts':
                        foreach($form_data[$key] as $k => $i) {
                            if(!empty($i)) {
                                $multiple_data[$key][$i] = [
                                    'participant_number' => (!empty($form_data['user_participant_discounts'][$k]) ? $form_data['user_participant_discounts'][$k] : null),
                                    'discounted_price' => (isset($form_data['participant_prices'][$k]) ? $form_data['participant_prices'][$k] : null),
                                    'start_at' => (isset($form_data['participant_discount_start_ats'][$k]) && !empty($form_data['participant_discount_start_ats'][$k]) ? date('Y-m-d H:i:s', strtotime($form_data['participant_discount_start_ats'][$k])) : null),
                                    'end_at' => (isset($form_data['participant_discount_end_ats'][$k]) && !empty($form_data['participant_discount_end_ats'][$k]) ? date('Y-m-d H:i:s', strtotime($form_data['participant_discount_end_ats'][$k])) : null),
                                    'is_same_provider' => (isset($form_data['participant_is_same_providers'][$k]) ? $form_data['participant_is_same_providers'][$k] : null),
                                ];
                            }
                        }
                        $data->{$key}()->delete();
                        $data->{$key}()->createMany($multiple_data[$key]);
                        break;
                    case 'related_review_products':
                        foreach($form_data[$key] as $k => $i) {
                            if(!empty($i)) {
                                $multiple_data[$key][$i] = [];
                            }
                        }
                        $data->{$key}()->sync($multiple_data[$key]);
                        break;
                    default:
                        foreach($form_data[$key] as $i) {
                            if(!empty($i)) {
                                array_push($multiple_data[$key], $i);
                            }
                        }
                        $data->{$key}()->sync($multiple_data[$key]);
                        break;
                }
            }else{
                $data->{$key}()->sync($multiple_data[$key]);
            }
        }
        return $data;
    }

    public function certificatePreview($slug) {
        $data = [];

        $product = Product::whereSlug($slug)->select(['id', 'module_number'])->first();
        if(!$product) {
            return abort(404);
        }

        $instructors = Instructor::join('instructor_product as ip', function($query) {
                            $query->on('instructors.id', '=', 'ip.instructor_id');
                        })
                        ->where('ip.product_id', $product->id)
                        ->orderBy('ip.sort', 'asc')
                        ->select([
                            'instructors.name as instructor_name', 'instructors.signature as instructor_signature',
                            'instructors.title as instructor_title',
                        ])
                        ->get();

        $longest_instructor_name = -1;
        foreach ($instructors as $instructor) {
            $instructor->base64_image = null;
            if($longest_instructor_name < strlen($instructor->instructor_name)) {
                $longest_instructor_name = strlen($instructor->instructor_name);
            }

            if(!$instructor->instructor_signature) {
                continue;
            }

            $image_url = asset_cdn($instructor->instructor_signature);
            if(!Storage::disk('gcs')->exists($instructor->instructor_signature)) {
                continue;
            }
            Storage::disk('gcs')->setVisibility($instructor->instructor_signature, 'public');
            $instructor->base64_image = $this->convertToBase64OfImage($image_url);
            Storage::disk('gcs')->setVisibility($instructor->instructor_signature, 'private');
        }

        $providers = Provider::leftJoin('product_provider as pp', function($query) {
                            $query->on('providers.id', '=', 'pp.provider_id');
                        })
                        ->where('pp.product_id', $product->id)
                        ->orderBy('pp.sort', 'asc')
                        ->select(['providers.name', 'providers.logo as provider_logo'])
                        ->get();

        foreach($providers as $provider) {
            $provider->base64_logo = null;
            if($provider->provider_logo) {
                $provider->base64_logo = $this->convertToBase64OfImage(asset_cdn($provider->provider_logo));
            }
        }

        $lms = new Lms;
        $course_detail = $lms->getCourseDetail($slug);
        if($course_detail['status'] != 200 || empty($course_detail['body'])) {
            return abort(404);
        }
        $total_rows = ceil($longest_instructor_name / 32);

        $data = [
            'instructor_detail' => [
                'instructors' => $instructors,
                'instructor_name_detail' => [
                    'length' => $longest_instructor_name,
                    'rows' => ($total_rows <= 0 ? 1: $total_rows),
                ],
            ],
            'providers' => $providers,
            'user' => (Object) [
                'name' => 'John Doe',
            ],
            'course_detail' => (Object)[
                'course_name' => $course_detail['body']['name'],
            ],
            'title' => 'E-Certificate',
            'certificate' => [
                'number' => $course_detail['body']['code'] . '-' . $product->module_number . '-' . date('Ymd') . '-0001',
                'issue_date' => Carbon::now()->format('d F Y'),
            ],
            'images' => []
        ];

        $images = [
            'background' => asset_cdn('pintaria/background/certificate-template.png'),
            'pintaria_logo' => asset_cdn('pintaria/Logo-Pintaria-big.png'),
        ];
        foreach($images as $key => $image) {
            $data['images'][$key] = $this->convertToBase64OfImage($image);
        }

        return PDF::loadView('pintaria3.certificate.pdf-template', $data)
                ->setPaper('a4')
                ->setOrientation('landscape')
                ->setOption('margin-bottom', 0)
                ->setOption('margin-top', 0)
                ->setOption('margin-left', 0)
                ->setOption('margin-right', 0)
                ->inline('e-certificate.pdf');
    }

    public function attendeeCardPreview($slug)
    {
        $product = Product::whereSlug($slug)
            ->select(['id', 'name', 'training_code', 'course_start_at', 'course_end_at', 'learning_method_id'])
            ->first();

        if (!$product) return abort(404);
        if (!$product->isOfflineCourse()) return abort(404);

        $no = AttendeeCard::getCurrentAttendeeNumber($product->id) + 1;

        $training_code = $product->training_code ?: 'XXX';

        $date = date_parse_from_format('Y-m-d H:i:s', $product->course_start_at);
        $course_date = sprintf('%02d', $date['month']) . substr($date['year'], -2);

        $provider = $product->providers()
            ->select('provider_code')
            ->orderByRaw('sort is null, sort ASC')
            ->first();
        $provider_code = isset($provider->provider_code) && !empty($provider->provider_code) ? $provider->provider_code : 'XX';

        $card_id = AttendeeCard::generateAttendeeCardId($no, $training_code, $course_date, $provider_code);

        $data[] = [
            'name' => 'John Doe',
            'attendee_card_id' => $card_id,
            'course' => $product->name,
            'date' => date('d/m/Y', strtotime($product->course_start_at)),
            'time' => date('H:i', strtotime($product->course_start_at)) . ' - ' . date('H:i', strtotime($product->course_end_at)) . ' WIB',
        ];

        return PDF::loadView('pintaria3.profiles' . '.attendee_card_template', ['attendees' => $data])
            ->setPaper('comm10e')
            ->setOrientation('landscape')
            ->setOption('margin-bottom', 0)
            ->setOption('margin-top', 0)
            ->setOption('margin-left', 0)
            ->setOption('margin-right', 0)
            ->inline('kartu-peserta-' . $slug . '.pdf');
    }


    private function processImage($request, $slug, $index) {
        $fullPath = null;
        if($request->hasFile($index)) {
            $file = $request->file($index);
            $filename = friendlyUrl($file->getClientOriginalName());
            $file_extension = '.' . $file->getClientOriginalExtension();
            $filename = str_replace($file_extension, '', $filename) . '-' . date('ymdHis');

            $path = 'pintaria/'.$slug.'/'.date('F').date('Y').'/';
            $fullPath = $path.$filename.'.'.$file->getClientOriginalExtension();

            Storage::disk(config('voyager.storage.disk'))->put($fullPath, file_get_contents($request->{$index}), 'public');
        }

        return $fullPath;
    }

    private function convertToBase64OfImage($image) {
        try {
            $type = pathinfo($image, PATHINFO_EXTENSION);
            $image_data = file_get_contents($image);
            return 'data:image/' . $type . ';base64,' . base64_encode($image_data);
        } catch (Exception $e) {
            return null;
        }
    }
}
