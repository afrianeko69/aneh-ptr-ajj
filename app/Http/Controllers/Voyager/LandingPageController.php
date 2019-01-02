<?php

namespace App\Http\Controllers\Voyager;

use Illuminate\Http\UploadedFile;
use Storage;
use App\LandingPage;
use App\Services\Departement;

class LandingPageController extends Controller
{
    public function insertUpdateData($request, $slug, $rows, $data) {
        $form_data = $request->except('_token', '_method');
        $multiple_data = [
            'landing_page_interests', 'interest_ids', 'interest_sorts',
            'landing_page_icons', 'icon_ids', 'icon_images', 'icon_images_old', 'icon_descriptions',
            'landing_page_testimonies', 'testimony_ids', 'testimony_titles', 'testimony_images', 'testimony_images_old', 'testimony_descriptions',
            'landing_page_universities', 'university_ids', 'university_sorts', 'university_images', 'university_images_old', 'university_locations',
        ];
        $dates = [];

        foreach($form_data as $index => $form) {
            if(!in_array($index, $multiple_data)) {
                if(in_array($index, $dates)) {
                    $data->{$index} = (!empty($form) ? Carbon::parse($form) : null);
                } else {
                    $data->{$index} = $form;
                }
            }
        }

        $images = [
            'main_image',
        ];
        foreach($images as $k) {
            $image_path = $this->processImage($request, $slug, $k);
            if($image_path) {
                $data->{$k} = $image_path;
            }
        }

        $data->save();

        $multiple_data = [
            'landing_page_interests' => [],
            'landing_page_icons' => [],
            'landing_page_testimonies' => [],
            'landing_page_universities' => [],
        ];

        foreach($multiple_data as $key => $option) {
            if(isset($form_data[$key])) {
                switch ($key) {
                    case 'landing_page_interests':
                        foreach($form_data[$key] as $k => $i) {
                            if(!empty($i)) {
                                $multiple_data[$key][$k] = [
                                    'name' => (isset($form_data['landing_page_interests'][$k]) && !empty($form_data['landing_page_interests'][$k]) ? $form_data['landing_page_interests'][$k] : null),
                                    'id' => (isset($form_data['interest_ids'][$k]) && !empty($form_data['interest_ids'][$k]) ? $form_data['interest_ids'][$k] : null),
                                    'sort' => (isset($form_data['interest_sorts'][$k]) && !empty($form_data['interest_sorts'][$k]) ? $form_data['interest_sorts'][$k] : null),
                                ];
                            }
                        }
                        $data->{$key}()->delete();
                        $data->{$key}()->createMany($multiple_data[$key]);
                        break;
                    case 'landing_page_icons':
                        foreach($form_data[$key] as $k => $i) {
                            if(!empty($i)) {
                                $multiple_data[$key][$k] = [
                                    'title' => (isset($form_data['landing_page_icons'][$k]) && !empty($form_data['landing_page_icons'][$k]) ? $form_data['landing_page_icons'][$k] : null),
                                    'id' => (isset($form_data['icon_ids'][$k]) && !empty($form_data['icon_ids'][$k]) ? $form_data['icon_ids'][$k] : null),
                                    'description' => (isset($form_data['icon_descriptions'][$k]) && !empty($form_data['icon_descriptions'][$k]) ? $form_data['icon_descriptions'][$k] : null),
                                ];

                                # Handle new images
                                # [ DB column => Request field ]
                                $images = [
                                    'image' => 'icon_images',
                                ];
                                foreach ($images as $col => $field) {
                                    $path = $this->processImage($request, $slug, $field, $k);
                                    # Save the new file if success, otherwise use old file
                                    $multiple_data[$key][$k] += [
                                        $col => $path ?: (isset($form_data[$field . '_old'][$k]) ? $form_data[$field . '_old'][$k] : null),
                                    ];
                                }
                            }
                        }
                        $data->{$key}()->delete();
                        $data->{$key}()->createMany($multiple_data[$key]);
                        break;
                    case 'landing_page_testimonies':
                        foreach($form_data[$key] as $k => $i) {
                            if(!empty($i)) {
                                $multiple_data[$key][$k] = [
                                    'person_name' => (isset($form_data['landing_page_testimonies'][$k]) && !empty($form_data['landing_page_testimonies'][$k]) ? $form_data['landing_page_testimonies'][$k] : null),
                                    'id' => (isset($form_data['testimony_ids'][$k]) && !empty($form_data['testimony_ids'][$k]) ? $form_data['testimony_ids'][$k] : null),
                                    'person_title' => (isset($form_data['testimony_titles'][$k]) && !empty($form_data['testimony_titles'][$k]) ? $form_data['testimony_titles'][$k] : null),
                                    'description' => (isset($form_data['testimony_descriptions'][$k]) && !empty($form_data['testimony_descriptions'][$k]) ? $form_data['testimony_descriptions'][$k] : null),
                                ];

                                $images = [
                                    'person_image' => 'testimony_images',
                                ];
                                foreach ($images as $col => $field) {
                                    $path = $this->processImage($request, $slug, $field, $k);
                                    $multiple_data[$key][$k] += [
                                        $col => $path ?: (isset($form_data[$field . '_old'][$k]) ? $form_data[$field . '_old'][$k] : null),
                                    ];
                                }
                            }
                        }
                        $data->{$key}()->delete();
                        $data->{$key}()->createMany($multiple_data[$key]);
                        break;
                    case 'landing_page_universities':
                        foreach($form_data[$key] as $k => $i) {
                            if(!empty($i)) {
                                $multiple_data[$key][$k] = [
                                    'name' => (isset($form_data['landing_page_universities'][$k]) && !empty($form_data['landing_page_universities'][$k]) ? $form_data['landing_page_universities'][$k] : null),
                                    'location' => (isset($form_data['university_locations'][$k]) && !empty($form_data['university_locations'][$k]) ? $form_data['university_locations'][$k] : null),
                                    'id' => (isset($form_data['university_ids'][$k]) && !empty($form_data['university_ids'][$k]) ? $form_data['university_ids'][$k] : null),
                                    'sort' => (isset($form_data['university_sorts'][$k]) && !empty($form_data['university_sorts'][$k]) ? $form_data['university_sorts'][$k] : null),
                                ];

                                $images = [
                                    'image' => 'university_images',
                                ];
                                foreach ($images as $col => $field) {
                                    $path = $this->processImage($request, $slug, $field, $k);
                                    $multiple_data[$key][$k] += [
                                        $col => $path ?: (isset($form_data[$field . '_old'][$k]) ? $form_data[$field . '_old'][$k] : null),
                                    ];
                                }
                            }
                        }
                        $data->{$key}()->delete();
                        $data->{$key}()->createMany($multiple_data[$key]);
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
            } else {
                $data->{$key}()->sync($multiple_data[$key]);
            }
        }
        return $data;
    }

    private function processImage($request, $slug, $index, $key = null) {
        $fullPath = $file = null;

        if (is_array($request->file($index)) && !empty($request->file($index)[$key])) {
            if ($request->file($index)[$key] instanceof UploadedFile) {
                $file = $request->file($index)[$key];
            }
        } elseif ($request->hasFile($index)) {
            $file = $request->file($index);
        }

        if ($file instanceof UploadedFile) {
            $filename = friendlyUrl($file->getClientOriginalName());
            $file_extension = '.' . $file->getClientOriginalExtension();
            $filename = str_replace($file_extension, '', $filename) . '-' . date('ymdHis');

            $path = 'pintaria/'.$slug.'/'.date('F').date('Y').'/';
            $fullPath = $path.$filename.'.'.$file->getClientOriginalExtension();

            Storage::disk(config('voyager.storage.disk'))->put($fullPath, file_get_contents($file), 'public');
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

    public function slugPreview($slug)
    {
        $lp = LandingPage::whereSlug($slug)->firstOrFail();

        $interests = $lp->landing_page_interests()->sort()->get();
        $icons = $lp->landing_page_icons()->get();
        $testimonies = $lp->landing_page_testimonies()->get();
        $universities = $lp->landing_page_universities()->sort()->get();
        $levelOfEducations = Departement::getLevelOfEducations();
        $locations = Departement::getLocations();
        
        return view('pintaria3.landingpage.slug-index', compact(
            'get', 'lp', 'interests', 'icons', 'testimonies', 'universities',
            'levelOfEducations', 'locations'
        ));
    }
}
