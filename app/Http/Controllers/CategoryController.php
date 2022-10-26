<?php

namespace App\Http\Controllers;

use App\Http\Helpers\Helper;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest()->get();
        return Helper::sendSuccess('Category Fetched Successfully',$categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
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
        $validated = Validator::make($request->all(),
        [
            'name' => 'required'
        ]
        );
        if($validated->fails()){
            Helper::sendError('Validation Failed',$validated->errors());
        }
        $created = Category::create($request->only('name'));
      return  Helper::sendSuccess('Category Successfully Created'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(  $category,Request $request)
    {
       
        $selectedCategory = Category::find($category);
       
        if(!$selectedCategory){
            Helper::sendError('Category Not Found');
        } 
        $validated = Validator::make($request->all(),[
            'name' => 'required'
        ]);
        if($validated->fails()){

            Helper::sendError('Validation Failed',$validated->errors());
        }else{
            $selectedCategory->update($request->only('name'));
            return Helper::sendSuccess('Category Successfully Updated');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy( $category)
    {
        $selectedCategory = Category::find($category);
       
        if(!$selectedCategory){
            Helper::sendError('Category Not Found');
        }
        $selectedCategory->delete();
        return Helper::sendSuccess('Category Successfully Deleted');
    }
}
