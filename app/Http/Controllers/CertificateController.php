<?php

namespace App\Http\Controllers;

use App\ClassAttendee;
use App\Instructor;
use App\Product;
use App\Provider;
use Exception;
use Illuminate\Http\Request;
use PDF;
use Storage;

class CertificateController extends Controller
{
    private $view = 'pintaria3.certificate';
    public function streamCertificate($slug) {
        $data = [];
        $user = auth()->user();

        $class_attendee = ClassAttendee::userCertificate($user->id, $slug)->firstOrFail();
        $product = $class_attendee->product;

        if(!$product){
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
            'user' => auth()->user(),
            'course_detail' => (Object) [
                'course_name' => $class_attendee->lms_course_name,
            ],
            'title' => 'E-Certificate',
            'certificate' => [
                'number' => $class_attendee->certificate_number,
                'issue_date' => $class_attendee->getUserTimezone('certificate_published_at', 'd F Y'),
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

        return PDF::loadView($this->view . '.pdf-template', $data)
                ->setPaper('a4')
                ->setOrientation('landscape')
                ->setOption('margin-bottom', 0)
                ->setOption('margin-top', 0)
                ->setOption('margin-left', 0)
                ->setOption('margin-right', 0)
                ->inline('e-certificate.pdf');
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
