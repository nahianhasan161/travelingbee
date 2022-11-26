<?php

namespace App\Http\Controllers;

use App\Http\Helpers\Helper;
use App\Http\Requests\PlaceRequest;
use App\Http\Resources\PlaceResource;
use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use PHPUnit\TextUI\Help;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $userID)
    {

       /*  if($userID){
            $places = Place::latest()
        ->where('user_id',3)->get();
        }else{

            $places = Place::latest()->get();
        }  */
        $places = Place::latest()->get();
        if($places){

            return Helper::sendSuccess('Succesfully Fetched Place',PlaceResource::collection(Cache::remember('places',60*60*24,function() use ($places) {
                return $places->all();
            }) ));
        }else{
            return Helper::sendError('Data Not Found');
        }
    }
    /* $places = Place::latest()->get(); */

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(PlaceRequest $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PlaceRequest $request)
    {


        $input = $request->only('name','description','features','rating','price','category_id','user_id','division','district','area');
        $place = Place::create($input);
         if($request->file('feature_image')){

            $imageName = '';
            /*  if($request->feature_image){

                $imagePath = public_path('/image/place/feature/'.$request->feature_image);
                if(File::exists($imagePath)){
                    unlink($imagePath);
                }
            }  */
            $file = $request->file('feature_image');
            $imageName = $file->getClientOriginalName();

            $file->move(public_path('image/place/feature/'),$imageName);
           $place->update([
                'feature_image' => $imageName
            ]);
        }


       return Helper::sendSuccess('Place Successfully Created',$input);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Place  $place
     * @return \Illuminate\Http\Response
     */
    public function show($place)
    {
        if($place){
           $currentPlace = Place::with('images','owner','bookings')->find($place);

        if($currentPlace){
        /* $place = new PlaceResource($currentPlace); */
            return Helper::sendSuccess('Succesfully Fetched Place',new PlaceResource($currentPlace));
           }
           else
           {
            Helper::sendError('Error! Can not find Place',$currentPlace);
           }
        }else{
            Helper::sendError('Error!');
        }


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Place  $place
     * @return \Illuminate\Http\Response
     */
    public function edit(Place $place)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Place  $place
     * @return \Illuminate\Http\Response
     */
    public function update( $place,PlaceRequest $request)
    {

        $thisPlace = Place::find($place);

       /* return Helper::sendSuccess('success', $request->only('name','description','features','rating','price','category_id','user_id'));   */
        if($thisPlace) {

            if($request->file('images')){
                foreach($request->file('images') as $image){
                    $imagesName = '';
                    /* Help::sendSuccess($request->file($image)) */
                    $file = $image;

                    $imagesName = $file->getClientOriginalName();
                    $file->move(public_path('image/place/more/'),$imagesName);
                $thisPlace->images()->create([
                    'name' => $imagesName
                ]);
                }

             }
             $input = $request->only('name','description','features','rating','price','category_id','user_id','division','district','area');
            $updated = $thisPlace->update($input);
            if($request->file('feature_image')){

                $imageName = '';
                 if($request->feature_image){

                    $imagePath = public_path('/image/place/feature/'.$request->feature_image);
                    if(File::exists($imagePath)){
                        unlink($imagePath);
                    }
                }
                $file = $request->file('feature_image');
                $imageName = $file->getClientOriginalName();

                $file->move(public_path('image/place/feature/'),$imageName);
                $thisPlace->update([
                    'feature_image' => $imageName
                ]);
            }


        }  else{ Helper::sendError('Data Not Found!');}


       return Helper::sendSuccess( $updated,$request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Place  $place
     * @return \Illuminate\Http\Response
     */
    public function destroy($place)
    {
       $thisPlace = Place::find($place);

       if($thisPlace) {
        $thisPlace->delete();
        return Helper::sendSuccess($thisPlace->name .' Succesfully Deleted');
       }  else{ Helper::sendError('Something Went Wrong');}


    }
}
