<?php

namespace App\Http\Controllers;

use App\Http\Helpers\Helper;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Http\Resources\BookingResource;
class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = BookingResource::collection(Booking::all());
        
        return Helper::sendSuccess('Fetched Suceesfully',$data);
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
       if($request){

           $date = $request->only('date');
           $user_id = $request->only('user_id');
           $place_id = $request->only('place_id');
        }
        /* 'required,date,after_or_equal:'. Carbon::now()->format('d-m-Y') , */

       /*  $messages = [
            date => 'This Already Booked'
        ]; */
      $validated =  Validator::make($request->all(),[
            'date' => ['required','date','after_or_equal:'. Carbon::now()->format('d-m-Y'), 
            Rule::unique('bookings')->where(function ($query) use($date,$user_id,$place_id) {
                return $query->where('place_id', $place_id)
                ->where('user_id', $user_id)
                ->where('date', $date);
            }),
            /* $messages */
        ],
            'user_id' => 'required',
            'place_id' => 'required',
        ]);
        if($validated->fails()){
           Helper::sendError('validation failed', $validated->errors());
        }
        
        Booking::create($request->only('date','user_id','place_id'));
        return Helper::sendSuccess('success', $request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show($booking)
    {
        $data = BookingResource::collection(Booking::where('user_id',$booking)->get());
        
        return Helper::sendSuccess('Fetched Suceesfully',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();
        return Helper::sendSuccess('Successfully Deleted');
    }
}
