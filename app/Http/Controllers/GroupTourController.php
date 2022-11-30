<?php

namespace App\Http\Controllers;

use App\Http\Helpers\Helper;
use App\Http\Requests\GroupTourRequest;
use App\Models\GroupTour;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class GroupTourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Helper::sendSuccess('GroupTour Fetch Successfull' , GroupTour::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(GroupTourRequest $request){

        /* return Helper::sendSuccess('plans' , $plans); */
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GroupTourRequest $request)
    {
        /*  $plans = explode('""',$request->plans); */
        /*   foreach($request->plans as $index=>$plan){
            return Helper::sendSuccess('Success' ,$plan);
        } */
        Helper::sendSuccess('hi',$request->date);
        $plans = $request->plans;

        $groupTour = $request->except('plans','images');

        $new = array_merge($groupTour,['date' =>  '2022-11-30 02:33:07']);

        /* Carbon::createFromFormat('d/m/Y',
        $groupTour['date'])->format('Y-m-d')]); */
        DB::transaction(function () use ($groupTour,$new,$plans,$request) {
            $tour = GroupTour::create($new);
            foreach($plans as $index=>$plan){

                $tour->plans()->create(
                    [
                        'place'=>$plan['place'],
                        'description'=>$plan['description'],
                        'category'=>$plan['category'],
                        'day'=>$plan['day'],

                    ]);
            }
        });
         return Helper::sendSuccess('Success' ,$request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GroupTour  $groupTour
     * @return \Illuminate\Http\Response
     */
    public function show($ID)
    {
        $grouptour = GroupTour::with('images','plans')->find($ID);
        if($grouptour){
           return  Helper::sendSuccess('Successfully Fetched GroupTour',$grouptour);
        }
        return Helper::sendError('Failed to Find GroupTour');
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
