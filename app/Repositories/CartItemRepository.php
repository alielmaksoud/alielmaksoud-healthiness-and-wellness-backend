<?php

namespace App\Repositories;

use App\CartItem;

class CartItemRepository implements CartItemRepositoryInterface
{
    public function display()
    {
        $items=CartItem::all();
       
        return $items;
    }
 
    public function view($id)
    {
        return CartItem::where('id', $id)->first();
    }
 
    public function create($request)
    {
        $data = $request->all();
        $category = CartItem::create([
                /*  'date'=>$data['date'], */
                 /* 'url'=>$data['url'], */
                 'name'=>$data['name'],
                 'image'=>$data['image'],
                 'description'=>$data['description'],
                'item_id' => $data['item_id'],
                'cart_id'=>$data['cart_id'],
                
            ]);
    }

   
    public function delete($id)
    {
        CartItem::where('id', $id)->delete();
    }

    public function erase()
    {
        Item::truncate();
        return response()->json([
            'message' => 'item deleted'
        ]);
    }
}