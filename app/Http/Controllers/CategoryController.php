<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\CategoryRequest;
use App\Repositories\CategoryRepositoryInterface;

use JWTAuth;

class CategoryController extends Controller
{
    protected $user;
    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository =$categoryRepository;
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
        $categories=$this->categoryRepository->display();
        return response()->json($categories);
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
    public function store(CategoryRequest $request)
    {
        // $validator=$request->validated();

        // if ($validator) {
            $category=$this->categoryRepository->createCategory($request);

            return response()->json([
                    'message' => 'Category Added',
                    'category' => $category
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
        $category=$this->categoryRepository->view($id);
        return response()->json($category);
    }
    
    public function displayItem($itemId)
    {
        return $this->categoryRepository->displayItem($itemId);
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
    public function update(CategoryRequest $request, $id)
    {
        $validator=$request->validated();


        if ($validator) {
            $category=$this->categoryRepository->update($request, $id);
            

            return response()->json(['status' => 200, 'category' => $category]);
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
        $category=$this->categoryRepository->delete($id);
        return response()->json([
            'message' => 'Category deleted'
        ]);
    }
}