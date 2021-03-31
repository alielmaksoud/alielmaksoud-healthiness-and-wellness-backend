<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Storage;

use App\Item;


class ItemRepository implements ItemRepositoryInterface
{
    public function display()
    {

        $items = Item::join('categories','categories.id', 'items.category_id')
        ->select('items.*', 'categories.category_name')
        ->get();
       /*  $data = [$items]; */
        return $items;
    }

    public function view($id)
    {
        $data = Item::where('id', $id)->first();
      /*   array_push($data); */
        return $data;
    }

    public function create($request)
    {
        $data = $request->all();
        $image = $request->file('image');
        $path = Storage::disk('public')->put('images', $image);
        if ($path) {
            $item = Item::create([
                'name'=>$data['name'],
                'description' => $data['description'],
                'date' => $data['date'],
                'url' => $data['url'],
                'image'=>$path,
                 'is_event'=>$data['is_event'],
                 'is_class'=>$data['is_class'],
                 'is_program'=>$data['is_program'],
                 'is_blog'=>$data['is_blog'],
                'category_id'=>$data['category_id'],
            ]);
           return response()->json([
                'message' => 'Item Added Successfully',
                'item' => $item
            ]);
        }else {
            return response()->json(['status' => 500, 'error' => "couldnt upload image"]);
        }
    }
    public function update($request, $id)
    {
        $data = $request->all();
        $image = $request->file('image');
        $path = Storage::disk('public')->put('images', $image);
        if($path){

        $item =Item::where('id', $id)->first();
        $item->name = $data['name'];
        $item->description = $data['description'];
        $item->date = $data['date'];
        $item->url = $data['url'];
        $item->image = $path;
        $item->is_event = $data['is_event'];
        $item->is_program = $data['is_program'];
        $item->is_class = $data['is_class'];
        $item->is_blog = $data['is_blog'];
        $item->category_id = $data['category_id'];
        $item->save();

       return response()->json(['status' => 200, 
       'message' => 'Item updated Successfully',
       'item' => $item]);

        }
        else {

            return response()->json(['staus' => 500, 'error' => "couldnt upload image"]);
        }
    }
    public function delete($id)
    {
        Item::where('id', $id)->delete();
        return response()->json([
            'message' => 'item deleted'
        ]);
    }
}