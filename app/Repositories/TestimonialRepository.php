<?php

namespace App\Repositories;

use App\Testimonial;
use Illuminate\Support\Facades\Storage;

class TestimonialRepository implements TestimonialRepositoryInterface
{
    public function display()
    {
        return $testimonial = Testimonial::all();
    }
 
    public function view($id)
    {
        return Testimonial::where('id', $id)->first();
    }
 
    public function create($request)
    {
        $data = $request->all();
        $image = $request->file('image');
        $path = Storage::disk('public')->put('images', $image);
        if ($path) {
            $testimonial = Testimonial::create([
                'name'=>$data['name'],
                'content' => $data['content'],
                'image'=>$path,
               
            ]);
            return response()->json([
                'message' => 'Testimonial Added',
                'Testimonial' => $testimonial
            ]);
        } else {
            return response()->json(['staus' => 500, 'error' => "couldnt upload image"]);
        }
    }
    public function update($request, $id)
    {
        $data = $request->all();
        $image = $request->file('image');
        $path = Storage::disk('public')->put('images', $image);
        if ($path) {
            $testimonial =Testimonial::where('id', $id)->first();
            $testimonial->name = $data['name'];
            $testimonial->content = $data['content'];
            $testimonial->image = $path['image'];
            $testimonial->save();
            return response()->json(['status' => 200, 'item' => $item]);
        } else {
            return response()->json(['staus' => 500, 'error' => "couldnt upload image"]);
        }
    }
    public function delete($id)
    {
        Testimonial::where('id', $id)->delete();
    }
}