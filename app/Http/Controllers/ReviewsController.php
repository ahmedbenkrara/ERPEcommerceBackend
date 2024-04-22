<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ReviewsRequest;
use App\Models\Reviews;
use App\Traits\HttpResponses;
use App\Http\Resources\ReviewsResource;

class ReviewsController extends Controller
{
    use HttpResponses;

    public function store(ReviewsRequest $request){
        $request->validated();
        $review = Reviews::create([
            'fullname' => $request->fullname,
            'email' => $request->email,
            'title' => $request->title,
            'rate' => $request->rate,
            'message' => $request->message,
            'type' => $request->type,
            'modele_id' => $request->modele_id,
            'package_id' => $request->package_id,
        ]);

        return new ReviewsResource($review);
    }

    public function destroy($id){
        $review = Reviews::find($id);
        if($review != null){
            $review->delete();
            return $this->success(null, 'Deleted successfully', 204);
        }else{
            return $this->error(null, 'Review not found', 404);
        }
    }

    public function numberOfReviews(){
        $count = Reviews::count();
        return $this->success($count, 'success', 200);
    }
}
