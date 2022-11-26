<?php

namespace App\Http\Controllers;

use App\Http\Helpers\Helper;
use App\Http\Resources\DivisionResource;
use Illuminate\Http\Request;
use App\Models\Division;

class DivisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $division = Division::with('districts')->get();
        return Helper::sendSuccess('Success',DivisionResource::collection($division));
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

       $division = Division::create($request->all());
        if($division){
            return Helper::sendSuccess('Successfully Created');
        }else{
            return Helper::sendError('Something went Wrong');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Division  $Division
     * @return \Illuminate\Http\Response
     */
    public function show($DivisionID)
    {
        $division = Division::find($DivisionID);
        if($division){
           return Helper::sendSuccess('success',$division);
        }
        else{
           return Helper::sendError('can not find division');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Division  $Division
     * @return \Illuminate\Http\Response
     */
    public function edit(Division $Division)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Division  $Division
     * @return \Illuminate\Http\Response
     */
    public function update($Division,Request $request)
    {
        $division = Division::find($Division);
        if($division){
            $division->update($request->all());
            return Helper::sendSuccess('Successfully Updated');
        }else{
            return Helper::sendError('Division Not Found');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Division  $Division
     * @return \Illuminate\Http\Response
     */
    public function destroy( $Division)
    {
        $division = Division::find($Division);
        if($division){
            $division->delete();
            return Helper::sendSuccess('Successfully Deleted');
        }else{
            return Helper::sendError('Division Not Found');
        }
    }
}
