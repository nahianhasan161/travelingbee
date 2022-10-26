<?php

namespace App\Http\Controllers;

use App\Http\Helpers\Helper;
use App\Http\Requests\PlaceRequest;
use App\Models\Place;
use Illuminate\Http\Request;
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
        
        return Helper::sendSuccess('succesfully Fetched Place',$places);
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
        $input = $request->all();
        Place::create($input);
       return Helper::sendSuccess('Place Successfully Created');
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
           $currentPlace = Place::find($place);
           if($currentPlace){
            return Helper::sendSuccess('Succesfully Fetched Place',$currentPlace);
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
    public function update( $place,Request $request)
    {
        $thisPlace = Place::find($place);
      
        if($thisPlace) {
            $input = $request->all();
            $updated = $thisPlace->update($input);
        }  else{ Helper::sendError('Something Went Wrong');}
       

       return Helper::sendSuccess( $updated); 
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
