<?php

namespace App\Repositories;

use App\Activity;

class ActivityRepository implements ActivityRepositoryInterface
{
    public function display()
    {
        return $activities = Activity::all();
    }
 
    public function view($id)
    {
        return Activity::where('id', $id)->first();
    }
 
    public function createActivity($request)
    {
        $data = $request->all();
            
            
        $activity = Activity::create([
                'Activity' => $data['Activity'],
            ]);
    }
    public function update($request, $id)
    {
        $data = $request->all();
        $activity = Activity::where('id', $id)->first();
        $activity->activity = $data['activity'];
        $activity->save();
    }
    public function delete($id)
    {
        Activity::where('id', $id)->delete();
    }
    public function displayItems($ItemId)
    {
        $activity = Activity::with('items')->findOrFail($ItemId);
        return response()->json([
            'user' => $activity
        ]);
    }
}