<?php

namespace App\Http\Controllers;

use App\Http\Helpers\Helper;
use App\Models\PlaceImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

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
       return Helper::sendSuccess('create Success');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $validated = Validator::make($request->all(),[


            'images.*' => 'required',
            'place_id' => 'required',

           ]);
            if($validated->fails()){
                $response = [
                    'success' => false,
                    'message' => $validated->errors()
                ];
                return response()->json($response,400);
            }
        if($request->file('images')){

            foreach($request->file('images') as $image){
                $imagesName = '';
                $file = $image;

                $imagesName = $file->getClientOriginalName();
                $file->move(public_path('image/place/more/'),$imagesName);

                PlaceImage::create([
                    'name' => $imagesName,
                    'place_id' => $request->place_id,
                ]);
            }


               return Helper::sendSuccess('Images Created Successfully');

         }
         else{
            return Helper::sendError('Images data not found');
         }
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
       return Helper::sendSuccess('edit Success');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PlaceImage  $placeImage
     * @return \Illuminate\Http\Response
     */
    public function update($ImageID,Request $request)
    {
        $validated = Validator::make($request->all(),[


            'feature_image' => 'required',


           ]);
            if($validated->fails()){
                $response = [
                    'success' => false,
                    'message' => $validated->errors()
                ];

        $image = PlaceImage::find($ImageID);
        if($image){
            if($request->file('image')){
                $imageName = '';
                $imagePath = public_path('/image/place/more/'.$request->feature_image);
                if(File::exists($imagePath)){
                    unlink($imagePath);
                }

               $file = $request->file('image');
               $imageName = $file->getClientOriginalName();

               $file->move(public_path('image/place/more/'),$imageName);

              $image->update([
                   'name' => $imageName
               ]);
               return Helper::sendSuccess('Image Successfully Updated');
           }else{

               return Helper::sendError('Uploaded Image Not Found');
           }
        }else{

            return Helper::sendError('Err..Image Not Updated');
        }
    }
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PlaceImage  $placeImage
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $image = PlaceImage::find($id);
        if($image){
            $image->delete();
            return Helper::sendSuccess('Image Successfully Deleted');
        }else{

            return Helper::sendError('Err..Image Not Deleted');
        }
    }
}
