<?php

namespace App\Http\Controllers;

use App\Http\Helpers\Helper;
use App\Http\Requests\DistrictRequest;
use App\Http\Resources\DistrictResource;
use App\Models\District;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $districts = District::all();
        return Helper::sendSuccess('Success',$districts);
    }

    public function getDistrictByID(Request $request)
    {
        $district = District::where('division_id',$request->only('id'))->get();
        return Helper::sendSuccess('Success',DistrictResource::collection($district));
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
public function store(DistrictRequest $request)
    {
      $district =  District::create($request->only('name','bn_name','url','division_id'));
      if($district){
        return Helper::sendSuccess('Successfully District Created');
      }else
      return Helper::sendError('District Creation Failed');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\District  $district
     * @return \Illuminate\Http\Response
     */
    public function show(District $district)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\District  $district
     * @return \Illuminate\Http\Response
     */
    public function edit(District $district)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\District  $district
     * @return \Illuminate\Http\Response
     */
    public function update($districtID,Request $request)
    {
        $district = District::find($districtID);
        if($district){
            $district->update($request->all());
            return Helper::sendSuccess('Successfully Updated District');
        }else{
            return Helper::sendError('District Not Found');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\District  $district
     * @return \Illuminate\Http\Response
     */
    public function destroy($districtID)
    {
        $district = District::find($districtID);
        if($district){
            $district->delete();
            return Helper::sendSuccess('Successfully Deleted District');
        }else{
            return Helper::sendError('District Not Found');
        }
    }
}
