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
use Illuminate\Validation\Rule;

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

     public function BookingByUser($place)
     {
        $currentPlace = Place::find($place);
        if($currentPlace){
           return Helper::sendSuccess('Success',  BookingResource::collection($currentPlace->bookings));
        }else{
            return Helper::sendError('Place Not Found');
        }
     }
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
   
    public function getBookingBy(Request $request)
    {
        $user = User::find($request->user_id);
        $place = Place::find($request->place_id);
        if(isset($user) && isset($place)){
           $bookings = Booking::where(['user_id' => $user->id,'place_id' => $place->id])->latest()->get();
            return Helper::sendSuccess(' Bookings by User & Place successfully fetch', $bookings );
        }
        elseif($user ){
            
            return Helper::sendSuccess('User Bookings successfully fetch', BookingResource::collection($user->bookingToPlace) );
        }elseif($place){
            return Helper::sendSuccess('Place Bookings successfully fetch', $place->bookingToUser);

        }
        else{
            return Helper::sendError('Can not find Data ');

        }
    }
     public function payments()
     {
        $user = User::find(1);
        $payments = $user->payments;
        return Helper::sendSuccess('Success',$payments);
     }
    public function store(Request $request)
    {
        $today = Carbon::now()->format('d-m-Y');
       /*  Rule::unique('bookings')->where(function ($query) use ($request) {
            return $query->where('user_id', $request->user_id)
               ->where('date', $request->date)
               ->where('place_id', $request->place_id);
            }); */
      $validated =  Validator::make($request->all(),[
            'date' => 'required|date|after_or_equal:'. Carbon::now()->format('d-m-Y').'|unique:bookings,date,NULL,id,place_id,' . $request['place_id']
           
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
    public function show($id)
    {
        $currentBooking = Booking::with('place','user','orders')->find($id);
      /*   $currentBooking = $currentBooking->place; */

       /*  $bookingPlace->booking =  $currentBooking; */
        /*   $bookingPlace->owner = User::find($currentBooking->user_id); */
        if($currentBooking){
        return Helper::sendSuccess('Data Fetch Successfull', new BookingResource($currentBooking)); 
        return Helper::sendError('Booking Not Found');
            
        }else{
        }
 /*    return Helper::sendSuccess('here', $currentUser); */
    }

    public function userBookingDetails($user)
    {
        $currentUser = User::find($user);
        
        if($currentUser){
            $places = $currentUser->bookings->unique('place_id')->all();
            return Helper::sendSuccess('Data Fetch Successfull',BookingResource::collection($places)); 
            /* return Helper::sendSuccess('Data Fetch Successfull',BookingResource::collection($currentUser->bookings));  */

        }else{
            return Helper::sendError('User Not Found');
        }
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
    public function destroy($booking)
    {
        $currentBooking = Booking::find($booking);

        if($currentBooking ){
            $currentBooking->delete();
            return Helper::sendSuccess('Successfully Cancled Booking');
        }else{
            return Helper::sendError($currentBooking);
        }
    }
}
