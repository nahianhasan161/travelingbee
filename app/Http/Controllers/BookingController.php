<?php

namespace App\Http\Controllers;

use App\Http\Helpers\Helper;
use App\Http\Resources\BookingResource;
use App\Http\Resources\InvoiceResource;
use App\Models\Booking;
use App\Models\Place;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Helper::sendError('up');
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
      $validated =  Validator::make($request->all(),[
            'date' => 'required|date|after_or_equal:'. Carbon::now()->format('d-m-Y'),
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
    public function show($user)
    {
        $currentUser = User::find($user);
       /*  foreach ($booking->bookingToPlace as $role) {
            $b = $role->pivot->date;
        }  */
        /* $booking->bookingToPlace */
     return Helper::sendSuccess('Data Fetch Successfull',BookingResource::collection($currentUser->bookingToPlace)); 
 /*    return Helper::sendSuccess('here', $currentUser); */
    }
    public function BookingDetails( $place)
    {
        
        $currentBooking = Booking::find($place);
       /*  foreach ($booking->bookingToPlace as $role) {
            $b = $role->pivot->date;
        }  */
        /* $booking->bookingToPlace */
     return Helper::sendSuccess('Data Fetch Successfull',BookingResource::collection($currentBooking)); 
 /*    return Helper::sendSuccess('here', $currentUser); */
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit($booking)
    {
       $currentBooking =  Place::with('bookingTOUser','owner')->find($booking);
       return Helper::sendSuccess('Data Fetch Successfull',new InvoiceResource($currentBooking)); 
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
        //
    }
}
