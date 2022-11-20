<?php

namespace App\Http\Controllers;

use App\Http\Helpers\Helper;
use App\Http\Requests\GroupTourRequest;
use App\Models\GroupTour;
use Illuminate\Http\Request;

class GroupTourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Helper::sendSuccess('Fetch Successfull' , GroupTour::latest());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(GroupTourRequest $request){
        return Helper::sendSuccess('plans' , $request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GroupTourRequest $request)
    {
        return Helper::sendSuccess('plans' , $request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GroupTour  $groupTour
     * @return \Illuminate\Http\Response
     */
    public function show(GroupTour $groupTour)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GroupTour  $groupTour
     * @return \Illuminate\Http\Response
     */
    public function edit(GroupTour $groupTour)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GroupTour  $groupTour
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GroupTour $groupTour)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GroupTour  $groupTour
     * @return \Illuminate\Http\Response
     */
    public function destroy(GroupTour $groupTour)
    {
        //
    }
}
