<?php

namespace App\Http\Controllers;

use App\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\ActivityRequest;
use App\Repositories\ActivityRepositoryInterface;

use JWTAuth;

class ActivityController extends Controller
{
    protected $user;
    protected $ActivityRepository;

    public function __construct(ActivityRepositoryInterface $activityRepository)
    {
        $this->activityRepository =$activityRepository;
        config()->set( 'auth.defaults.guard', 'admin' );
        $this->user = JWTAuth::parseToken()->authenticate();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activities=$this->activityRepository->display();
        return response()->json($activities);
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
    public function store(ActivityRequest $request)
    {
        // $validator=$request->validated();

        // if ($validator) {
            $activity=$this->activityRepository->createActivity($request);

            return response()->json([
                    'message' => 'activity Added',
                    'activity' => $activity
                ]);
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $activity=$this->activityRepository->view($id);
        return response()->json($activity);
    }
    public function displayItem($itemId)
    {
        return $this->activityRepository->displayItem($itemId);
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
    public function update(ActivityRequest $request, $id)
    {
        $validator=$request->validated();


        if ($validator) {
            $activity=$this->activityRepository->update($request, $id);
            

            return response()->json(['status' => 200, 'activity' => $activity]);
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
        $activity=$this->activityRepository->delete($id);
        return response()->json([
            'message' => 'activity deleted'
        ]);
    }
}