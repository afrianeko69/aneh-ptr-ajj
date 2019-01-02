<?php
namespace App\Services;

use Exception;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Client;

class Lms {

    private $partner_id = 1;
    private $timezone = 'Asia/Jakarta';
    private $program_study_id = 1;
    private $academic_year_id = 1;
    private $student_status = 'aktif';

    private $client;
    private $response;

    public function __construct() {
        $this->response['status'] = 400;
        $this->response['message'] = 'Maaf, saat ini kami sedang mengalami kendala dalam memproses data anda.';
        $this->client = new Client();
    }

    public function setPartnerId($partner_id) {
        $this->partner_id = $partner_id;
        return $this;
    }

    public function getPartnerId() {
        return $this->partner_id;
    }

    public function setTimezone($timezone) {
        $this->timezone = $timezone;
        return $this;
    }

    public function getTimezone() {
        return $this->timezone;
    }

    public function setProgramStudyId($program_study_id) {
        $this->program_study_id = $program_study_id;
        return $this;
    }

    public function getProgramStudyId() {
        return $this->program_study_id;
    }

    public function setAcademicYearId($academic_year_id) {
        $this->academic_year_id = $academic_year_id;
        return $this;
    }

    public function getAcademicYearId() {
        return $this->academic_year_id;
    }

    public function setStudentStatus($student_status) {
        $this->student_status = $student_status;
        return $this;
    }

    public function getStudentStatus() {
        return $this->student_status;
    }

    private function getAuthorization() {
        return config('services.pintaria.client_secret');
    }

    private function getAuthorizationHeaderStructure() {
        return ['Authorization' => self::getAuthorization()];
    }

    private function getLMSAPIEndpoint() {
        return config('services.lms.api_url');
    }

    public function createUserPintaria($firebase_uid, $email, $name, $send_email = true) {
        try {
            $endpoint = self::getLMSAPIEndpoint() . 'usersPintaria';
            $request = $this->client->post($endpoint, [
                'json' => [
                    'firebase_uid' => $firebase_uid,
                    'email' => $email,
                    'name' => $name,
                    'partner_id' => self::getPartnerId(),
                    'program_study_id' => self::getProgramStudyId(),
                    'academic_year_id' => self::getAcademicYearId(),
                    'student_status' => self::getStudentStatus(),
                    'timezone' => self::getTimezone(),
                    'is_send_email' => $send_email,
                ]
            ]);

            $this->response['status'] = $request->getStatusCode();
            if($this->response['status'] == 201) {
                $this->response['message'] = 'Sukses register di LMS';
                $this->response['body'] = json_decode((string) $request->getBody(), true);
            }
        } catch (Exception $e) {
        }
        return $this->response;
    }

    public function getUserKlass($lms_user_id) {
        try {
            $endpoint = self::getLMSAPIEndpoint() . 'class_attendees/' . $lms_user_id;
            $request = $this->client->get($endpoint, [
                'headers' => self::getAuthorizationHeaderStructure()
            ]);

            $this->response['status'] = $request->getStatusCode();
            $this->response['message'] = 'success';
            $this->response['data'] = json_decode((string) $request->getBody());
        } catch (Exception $e) {
        }
        return $this->response;
    }

    public function enrollUserToCourse($lms_user_id, $slug) {
        try {
            $endpoint = self::getLMSAPIEndpoint() . 'class_attendees';
            $request = $this->client->post($endpoint, [
                'headers' => self::getAuthorizationHeaderStructure(),
                'json' => [
                    'user_id' => $lms_user_id,
                    'slug' => $slug
                ]
            ]);

            $this->response['status'] = $request->getStatusCode();
            $this->response['message'] = 'success';
            if($request->getStatusCode() == 201) {
                $this->response['body'] = json_decode((string) $request->getBody(), true)['data'];
            }
        } catch (Exception $e) {
        }
        return $this->response;
    }

    public function checkStudentKlassStatus($lms_user_id, $slug) {
        try {
            $endpoint = self::getLMSAPIEndpoint() . 'class_attendees?user_id=' . $lms_user_id .'&slug=' . $slug;
            $request = $this->client->get($endpoint, [
                'headers' => self::getAuthorizationHeaderStructure()
            ]);

            $this->response['status'] = $request->getStatusCode();
            if($this->response['status'] == 200) {
                $body_response = json_decode((string) $request->getBody());
                $this->response['message'] = 'success';
                $this->response['body'] = $body_response->data;
            }
        } catch (Exception $e) {
        }
        return $this->response;
    }

    /**
    * This function will handle API calls to LMS (Update Database)
    * The received params to this function are
    * 1. user_id => the user_id on lmsums database table user, on Pintaria database take from provider_id
    * 2. name => required
    * 3. profile_picture_object => optional
    * 4. address => optional
    * 5. phone_number => optional
    * 6. mobile_number => optional
    */
    public function updateUserDetail($data) {
        try {
            $endpoint = self::getLMSAPIEndpoint() .'users';
            $request = $this->client->put($endpoint, [
                'headers' => self::getAuthorizationHeaderStructure(),
                'json' => $data
            ]);
            $this->response['status'] = $request->getStatusCode();
            $this->response['message'] = 'success';
        } catch (Exception $e) {
        }
        return $this->response;
    }


    public function getSectionAndSectionUnitDetailByCourseSlug($course_slug) {
        try {
            $endpoint = self::getLMSAPIEndpoint() . 'courses/' . $course_slug . '/materials';
            $request = $this->client->get($endpoint, [
                'headers' => self::getAuthorizationHeaderStructure()
            ]);
            $this->response['status'] = $request->getStatusCode();
            if($this->response['status'] == 200) {
                $body_response = json_decode((string) $request->getBody(), true);
                $this->response['message'] = 'success';

                $body_response = $body_response['data']['materials'];
                foreach($body_response as $key => $res) {
                    if(isset($res['section_units'][0]['name'])) {
                        foreach($res['section_units'] as $k => $unit) {
                            $icon = 'fa-file-text';
                            $unique_unit_content_type = array_unique($unit['content_type']);
                            if(count($unique_unit_content_type) < 2) {
                                $icon = $this->convertContentTypeToIcon($unique_unit_content_type[0]);
                            }

                            $body_response[$key]['section_units'][$k]['icon'] = $icon;
                            unset($body_response[$key]['section_units'][$k]['content_type']);
                        }
                    } else {
                        $section_units = [];
                        foreach($res['section_units'] as $unit) {
                            $section_units[] = [
                                'name' => $unit,
                                'icon' => null
                            ];
                        }
                        $body_response[$key]['section_units'] = $section_units;
                    }
                }

                $this->response['body'] = $body_response;
            }
        } catch (Exception $e) {
        }
        return $this->response;
    }

    private function convertContentTypeToIcon($content_type) {
        switch ($content_type) {
            case 'video':
                return 'fa-play-circle';
            case 'audio':
                return 'fa-volume-up';
            case 'presentation':
                return 'fa-files-o';
            case 'lecture_note':
            case 'note':
            case 'notes':
                return 'fa-pencil-square-o';
            case 'quiz':
            case 'pre_quiz':
            case 'post_quiz':
            case 'exercise':
                return 'fa-bar-chart';
            case 'assignment':
            case 'ringkasan':
            case 'learning_objective':
            case 'conclusion':
                return 'fa-bars';
            case 'file':
            case 'files':
                return 'fa-file';
            default:
                return 'fa-folder';
        }
    }

    public function getCourseDetail($slug) {
        try {
            $endpoint = self::getLMSAPIEndpoint() . 'courses/' . $slug;
            $request = $this->client->get($endpoint, [
                'headers' => self::getAuthorizationHeaderStructure(),
            ]);
            $this->response['status'] = $request->getStatusCode();
            $this->response['message'] = 'success';
            $this->response['body'] = json_decode((string) $request->getBody(), true);
        } catch (Exception $e) {
        }
        return $this->response;
    }
}