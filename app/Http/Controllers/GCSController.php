<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use Storage;

class GCSController extends Controller
{
    public function getFile($gcs_path)
    {
        $gcs_path = urldecode($gcs_path);

        if (!Storage::disk('lmsums_gcs')->exists($gcs_path)) {
            abort(404);
        }

        $image = Storage::disk('lmsums_gcs')->get($gcs_path);
        $mime_type = Storage::disk('lmsums_gcs')->mimeType($gcs_path);

        return Response::make($image)->header('Content-Type', $mime_type);
    }

    public function getPintariaPrivateFile($gcs_path) {
        $gcs_path = urldecode($gcs_path);

        if (!Storage::disk('gcs')->exists($gcs_path)) {
            return abort(404);
        }

        $image = Storage::disk('gcs')->get($gcs_path);
        $mime_type = Storage::disk('gcs')->mimeType($gcs_path);

        return Response::make($image)->header('Content-Type', $mime_type);
    }
}
