<?php

namespace App\Http\Controllers;

use App\Genders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\GenderRequest;
use App\Repositories\GenderRepositoryInterface;

use JWTAuth;

class GendersController extends Controller
{
    protected $user;
    protected $GenderRepository;

    public function __construct(GenderRepositoryInterface $genderRepository)
    {
        $this->genderRepository =$genderRepository;
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
        $genders=$this->genderRepository->display();
        return response()->json($genders);
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
    public function store(GenderRequest $request)
    {
        // $validator=$request->validated();

        // if ($validator) {
            $gender=$this->genderRepository->createGender($request);

            return response()->json([
                    'message' => 'Gender Added',
                    'gender' => $gender
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
        $gender=$this->genderRepository->view($id);
        return response()->json($gender);
    }
    public function displayItem($itemId)
    {
        return $this->genderRepository->displayItem($itemId);
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
    public function update(GenderRequest $request, $id)
    {
        $validator=$request->validated();


        if ($validator) {
            $gender=$this->genderRepository->update($request, $id);
            

            return response()->json(['status' => 200, 'gender' => $gender]);
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
        $gender=$this->genderRepository->delete($id);
        return response()->json([
            'message' => 'Gender deleted'
        ]);
    }
}