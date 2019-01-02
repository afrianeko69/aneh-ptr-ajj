<?php

namespace App\Http\Controllers\Voyager;

use App\RatingReview;
use App\Http\Requests\Voyager\UpdateRatingReviewRequest;
use Illuminate\Http\Request;
use TCG\Voyager\Facades\Voyager;
use Session;

class RatingReviewController extends Controller
{
    public function approveRejectAction(UpdateRatingReviewRequest $request) {
        $dataType = Voyager::model('DataType')->where('slug', 'rating-reviews')->first();
        Voyager::canOrFail('edit_'.$dataType->name);

        $data = $request->all();
        $status = 'Pending';
        switch ($data['type']) {
            case 'approve':
                $status = 'Approved';
                break;
            
            case 'reject':
                $status = 'Rejected';
                break;
        }

        $bulk_update = RatingReview::whereIn('id', $data['rating_review_id'])
                ->update([
                    'status' => $status,
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
        if($bulk_update) {
            Session::flash('message-success', 'Success to '. $data['type'] . ' review');
            return response()->json(['success' => true], 200);
        }
        Session::flash('message-error', 'Failed to '. $data['type'] . ' review');
        return response()->json(['success' => false], 400);
    }
}
