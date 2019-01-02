<?php

namespace App;

use App\Traits\UserTimezone;
use Illuminate\Database\Eloquent\Model;

class ClassAttendee extends Model
{
    use UserTimezone;

    protected $fillable = [
        'lms_klass_id',
        'lms_course_id',
        'user_id',
        'lms_course_name',
        'slug',
        'lms_custom_url',
        'certificate_number',
        'certificate_published_at',
        'created_at',
        'updated_at',
    ];

    protected $dates = [
        'created_at', 'updated_at', 'certificate_published_at',
    ];

    public function product() {
        return $this->belongsTo('App\Product', 'slug', 'slug');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function scopeUserCoursesBySlug($query, $user_id, $product_slug) {
        return $query->courseSlug($product_slug)->whereUserId($user_id);
    }

    public function scopeUserCertificate($query, $user_id, $product_slug) {
        return $query->userCoursesBySlug($user_id, $product_slug)->whereNotNull('certificate_number');
    }

    public function scopeCourseSlug($query, $slug) {
        return $query->whereSlug($slug);
    }
}
