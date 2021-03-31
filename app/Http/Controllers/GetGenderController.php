<?php

namespace App\Http\Controllers;

use App\Genders;
use Illuminate\Http\Request;


class GetGenderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gender=Genders::all();
        return response()->json($gender);
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $gender=Genders::where('id', $id)->first();
        return response()->json($gender);
    }

}