<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;


class GetCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories=Category::all();
        return response()->json($categories);
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category=Category::where('id', $id)->first();
        return response()->json($category);
    }

}