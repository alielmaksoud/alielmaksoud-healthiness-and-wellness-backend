<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\ItemRequest;
use App\Repositories\ItemRepository;

use JWTAuth;

class ItemController extends Controller
{
    protected $user;
    protected $itemRepository;

    public function __construct(ItemRepository $itemRepository)
    {
        config()->set('auth.defaults.guard', 'admin');
        $this->itemRepository =$itemRepository;
        $this->user = JWTAuth::parseToken()->authenticate();

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items=$this->itemRepository->display();
        return response()->json($items);
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
    public function store(ItemRequest $request)
    {
        $validator=$request->validated();

        if ($validator) {

            $item=$this->itemRepository->create($request);
            return $item;
            
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
        $item=$this->itemRepository->view($id);
        return response()->json($item);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ItemRequest $request, $id)
    {
         $validator=$request->validated();

         if ($validator) {
             $item=$this->itemRepository->update($request, $id);
        

             return response()->json(['status' => 200, 'item' => $item]);
         }
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item=$this->itemRepository->delete($id);
        return response()->json([
            'message' => ' Item deleted'
        ]);
    }

  
}