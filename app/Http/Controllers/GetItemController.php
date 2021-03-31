<?php

namespace App\Http\Controllers;

use App\Item;
use App\UsdRate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class GetItemController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        try{
            $items = Item::join('categories','categories.id', 'items.category_id')
            ->select('items.*', 'categories.category_name')
            ->get();
           /*  $data = [$items]; */
           
            if($items){
                return response()->json([
                    'data'=> $items
                ],200);
            }
            return response()->json([
                'item'=>"empty"

            ],404);
        }
        catch(\Exception $e){
            return response()->json([
                'message'=>'internal error'
            ],500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Item::where('items.id', $id)
        -> join('categories','categories.id', 'items.category_id')
        ->select('items.*', 'categories.category_name')
        ->get();
         
        if($item)
        {
            return response()->json([
                'data'=> $item
            ],200);
        }
        return response()->json([
            'item'=>'item could not be found' 
        ],500);
    }


   /*  public function getHomeItem(){
      $items = Item::join('categories','categories.id', 'items.category_id')
      ->select('items.*', 'categories.category_name')
      ->with('itemAttributes')->inRandomOrder()->limit(5)->get();
      $rate = UsdRate::Where('id', '1')->get('rate');
      $data = [$items, $rate];
      return response()->json([
        'data'=> $data
    ],200);
    } */

}