<?php

namespace App\Repositories;

use App\Category;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function display()
    {
        return $categories = Category::all();
    }
 
    public function view($id)
    {
        return Category::where('id', $id)->first();
    }
 
    public function createCategory($request)
    {
        $data = $request->all();
            
            
        $category = Category::create([
                'category_name' => $data['category_name'],
                'description'=>$data['description'],
            ]);
    }
    public function update($request, $id)
    {
        $data = $request->all();
        $category = Category::where('id', $id)->first();
        $category->category_name = $data['category_name'];
        $category->description = $data['description'];
        $category->save();
    }
    public function delete($id)
    {
        Category::where('id', $id)->delete();
    }
    public function displayItems($ItemId)
    {
        $category = Category::with('items')->findOrFail($ItemId);
        return response()->json([
            'user' => $category
        ]);
    }
}