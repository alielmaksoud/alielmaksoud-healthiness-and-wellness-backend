<?php

namespace App\Http\Controllers;

use App\Status;
use Illuminate\Http\Request;


class GetStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $status=Status::all();
        return response()->json($status);
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $status=Status::where('id', $id)->first();
        return response()->json($status);
    }

}