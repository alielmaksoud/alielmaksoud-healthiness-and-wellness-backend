<?php

namespace App\Repositories;

use App\Genders;

class GenderRepository implements GenderRepositoryInterface
{
    public function display()
    {
        return $genders = Genders::all();
    }
 
    public function view($id)
    {
        return Genders::where('id', $id)->first();
    }
 
    public function createGender($request)
    {
        $data = $request->all();
            
            
        $gender = Genders::create([
                'Gender' => $data['Gender'],
            ]);
    }
    public function update($request, $id)
    {
        $data = $request->all();
        $gender = Genders::where('id', $id)->first();
        $gender->gender = $data['gender'];
        $gender->save();
    }
    public function delete($id)
    {
        Genders::where('id', $id)->delete();
    }
    public function displayItems($ItemId)
    {
        $gender = Genders::with('items')->findOrFail($ItemId);
        return response()->json([
            'user' => $gender
        ]);
    }
}