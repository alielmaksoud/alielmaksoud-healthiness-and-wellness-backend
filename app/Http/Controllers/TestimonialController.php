<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\TestimonialRepository;
use App\Http\Requests\TestimonialRequest;
use App\Testimonial;
use JWTAuth;

class TestimonialController extends Controller
{
   /*  protected $user; */
   

    public function __construct(TestimonialRepository $testimonialRepository)
    {
        $this->testimonialRepository =$testimonialRepository;
        config()->set('auth.defaults.guard', 'api');
         /* $this->user = JWTAuth::parseToken()->authenticate(); */
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $testimonials=$this->testimonialRepository->display();
        return response()->json($testimonials);
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
    public function store(TestimonialRequest $request)
    {
        $validator=$request->validated();

        if ($validator) {
            $testimonial=$this->testimonialRepository->create($request);

            return response()->json([
                    'message' => 'Testimonial Added',
                    'testimonial' => $testimonial
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
        $testimonial=$this->testimonialRepository->view($id);
        return response()->json($testimonial);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TestimonialRequest $request, $id)
    {
        $validator=$request->validated();


        if ($validator) {
            $testimonial=$this->testimonialRepository->update($request, $id);
            

            return response()->json(['status' => 200, 'testimonial' => $testimonial]);
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
        $testimonial=$this->testimonialRepository->delete($id);
        return response()->json([
            'message' => ' testimonial deleted'
        ]);
    }
}