<?php

namespace App\Http\Controllers;

use App\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\CartItemRequest;
use App\Repositories\CartItemRepository;

use JWTAuth;

class CartItemController extends Controller
{
    protected $user;
    protected $cartItemRepository;

    public function __construct(CartItemRepository $cartItemRepository)
    {
        $this->cartItemRepository =$cartItemRepository;
        config()->set( 'auth.defaults.guard', 'api' );
        $this->user = JWTAuth::parseToken()->authenticate();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cartItems=$this->cartItemRepository->display();
        return response()->json($cartItems);
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
    public function store(CartItemRequest $request)
    {
        $validator=$request->validated();

        if ($validator) {
            $cartItem=$this->cartItemRepository->create($request);

            return response()->json([
                    'message' => 'CartItem Added',
                    'CartItem' => $cartItem
                ]);
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
        $cartItem=$this->cartItemRepository->view($id);
        return response()->json($cartItem);
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
    public function update(CartItemRequest $request, $id)
    {
        $validator=$request->validated();


        if ($validator) {
            $cartItem=$this->cartItemRepository->update($request, $id);
            

            return response()->json(['status' => 200, 'cartItem' => $cartItem]);
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
        $cartItem=$this->cartItemRepository->delete($id);
        return response()->json([
            'message' => 'Item deleted'
        ]);
    }
}