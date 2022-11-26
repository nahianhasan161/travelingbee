<?php

namespace App\Http\Controllers;

use App\Http\Helpers\Helper;
use App\Models\Place;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Resources\ReviewResource;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{

    public function storeByPlace($placeID,Request $request)
    {
        $validated = Validator::make($request->all(),[


            'rating' => 'required|numeric|min:1|max:5',
            'description' => 'required|max:250',
            'user_id' => 'required',

           ]);
            if($validated->fails()){
               /*  $response = [
                    'success' => false,
                    'message' => $validated->errors()
                ]; */
                return Helper::sendError('validation Failed',$validated->errors());
            }
        $place = Place::find($placeID);
        if($place){
            $review = Review::create($request->all());
            $review->places()->attach($placeID);
            return Helper::sendSuccess('success',$request->all());
        }else{
            return Helper::sendError('Can not find Place');

        }

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show($placeID,Request $request)
    {
        $place = Place::find($placeID) ? Place::find($placeID) : [];
        if($place){
            if($request){

                 $reviews = $place->reviews->sortByDesc('rating');
                $reviews =  $place->reviews->sortBy([
                    fn($a, $b) => (1 === $b->user->id) ? 1 : ($a->created_at <=> $b->created_at)
                ]);
                /* ->groupBy('user_id') */
            }else{
                $reviews = $place->reviews; /* ->groupBy('created_at','desc') */
            }
            /* ReviewResource::collection($reviews) */
        return Helper::sendSuccess('successfully fetch reviews',ReviewResource::collection($reviews));
        }else{

            return Helper::sendError('place not found');
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Place $place,Request $request )
    {
        return Helper::sendSuccess('success',$place);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy($review)
    {
        $rev = Review::find($review);
        if($rev){
            $rev->delete();
            return Helper::sendSuccess('Successfully Deleted');
        }else{
        return Helper::sendError(' Deleteing Review Failed');

        }
    }
}
