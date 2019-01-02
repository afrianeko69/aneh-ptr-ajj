<?php

namespace App\Http\Middleware;

use App\ClassAttendee;
use Closure;

class CoursePermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $product_slug = $request->slug;
        $user = auth()->user();

        $class_attendee = ClassAttendee::userCoursesBySlug($user->id, $product_slug)->first(['id']);
        if(!$class_attendee) {
            return abort(404);
        }

        return $next($request);
    }
}
