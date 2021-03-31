<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use Illuminate\Support\Facades\Validator;
use App\Repositories\CartRepository;
use App\Response;

use App\Http\Requests\CartRequest;
use JWTAuth;

class CartController extends Controller
{
    protected $user;

    public function __construct(CartRepository $cartRepository)
    {
        $this->cartRepository =$cartRepository;
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
        $carts=$this->cartRepository->display();

        // $user = Auth::user();
        // $carts=$this->cartRepository->display()->where('user_id', $user->id)->get();

        return response()->json($carts);
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
    public function store(CartRequest $request)
    {
        // $validator=$request->validated();
       
        // if ($validator) {
        //     $cart=$this->cartRepository->create($request);
        //     $data=$request->all();
        //     return Response::success($data, "Cart Added");
        // }
        // return Response::error(401, "Cart Not Added", "Invalid Data");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cart=$this->cartRepository->view($id);
        return response()->json($cart);
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
    public function update(CartRequest $request, $id)
    {
        // $validator=$request->validated();

        // if ($validator) {
        //     $cart=$this->cartRepository->update($request, $id);
        //     $data=$request->all();
        //     return response()->json(['status' => 200, 'cart' => $data]);
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $cart=$this->cartRepository->delete($id);
        // return response()->json([
        //     'message' => 'cart deleted'
        // ]);
    }
}