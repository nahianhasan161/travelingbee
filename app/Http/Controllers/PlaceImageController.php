<?php

namespace App\Http\Controllers;

use App\Http\Helpers\Helper;
use App\Models\PlaceImage;
use Illuminate\Http\Request;

class PlaceImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $images = PlaceImage::where('place_id',$request->only('id'))->get();
        if($images){
            return Helper::sendSuccess('success',$images);
         }
         else{
            return Helper::sendError('can not find Images');
         }



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
     * @param  \App\Models\PlaceImage  $placeImage
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $images = PlaceImage::where('place_id',$id)->get();
        if($images){
            return Helper::sendSuccess('success',$id);
         }
         else{
            return Helper::sendError('can not find Images');
    }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PlaceImage  $placeImage
     * @return \Illuminate\Http\Response
     */
    public function edit(PlaceImage $placeImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PlaceImage  $placeImage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PlaceImage $placeImage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PlaceImage  $placeImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(PlaceImage $placeImage)
    {
        //
    }
}
