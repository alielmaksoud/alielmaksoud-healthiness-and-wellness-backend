<?php

namespace App\Http\Controllers;

use App\Activity;
use Illuminate\Http\Request;


class GetActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activity=Activity::all();
        return response()->json($activity);
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $activity=Activity::where('id', $id)->first();
        return response()->json($activity);
    }

}