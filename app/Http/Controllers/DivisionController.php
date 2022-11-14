<?php

namespace App\Http\Controllers;

use App\Http\Helpers\Helper;
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
        $division = Division::all();
        return Helper::sendSuccess('Success',$division);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Division  $Division
     * @return \Illuminate\Http\Response
     */
    public function show(Division $Division)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Division  $Division
     * @return \Illuminate\Http\Response
     */
    public function edit(Division $Division)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Division  $Division
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Division $Division)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Division  $Division
     * @return \Illuminate\Http\Response
     */
    public function destroy(Division $Division)
    {
        //
    }
}
