<?php

namespace App\Http\Controllers;

use App\Http\Helpers\Helper;
use App\Http\Requests\AreaRequest;
use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Upazila = Area::all();
        return Helper::sendSuccess('Success',$Upazila);
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

public function areasByDistrictID(Request $request)
{
    $areas = Area::where('district_id',$request->only('id'))->get();
    if($areas){
        return Helper::sendSuccess('Successfully fetch Areas',$areas);
    }else{

        return Helper::sendError('Areas Not Found');
    }
}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AreaRequest $request)
    {
        $area =  Area::create($request->only('name','bn_name','url','district_id'));
        if($area){
          return Helper::sendSuccess('Successfully Area Created');
        }else
        return Helper::sendError('Area Creation Failed');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function show($areaID)
    {
        $area = Area::find($areaID);
        if($area){

            return Helper::sendSuccess('Successfully Fetch Area',$area);
        }else{
            return Helper::sendError('Area Not Found');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function edit(Area $area)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function update($areaID,Request $request)
    {
        $area = Area::find($areaID);
        if($area){
            $area->update($request->all());
            return Helper::sendSuccess('Successfully Updated Area');
        }else{
            return Helper::sendError('Area Not Found');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function destroy($areaID)
    {
        $area = Area::find($areaID);
        if($area){
            $area->delete();
            return Helper::sendSuccess('Successfully Deleted Area');
        }else{
            return Helper::sendError('Area Not Found');
        }
    }
}
