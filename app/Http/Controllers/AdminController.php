<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Validator;

use App\Repositories\AdminRepository;
use App\Repositories\UserRepository;
use App\Http\Requests\AdminRegisterRequest;
use App\Http\Requests\AdminUpdateRequest;
use App\Http\Requests\AdminLoginRequest;
use App\Response;
use App\Admin;
use App\User;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct(AdminRepository $adminRepository)
    {
        $this->adminRepository =$adminRepository;
        $this->middleware('auth:admin', ['except' => ['login', 'register']]);
    }


    /////// user

    /**
      * Display a listing of the resource.
      *
      * @return \Illuminate\Http\Response
      */
    public function indexuser()
    {
        $users = User::join('statuses','statuses.id', 'users.status_id')
        ->select('users.*', 'statuses.status')
        ->get();
        $act = User::join('activities','activities.id', 'users.activity_id')
        ->select('users.*','activities.activity')
        ->get();
        $gend = User::join('genders','genders.id', 'users.gender_id')
        ->select('users.*','genders.gender')
        ->get();
        $data = [$users, $act, $gend];
        return $data;

        /* $users = User::join('statuses','statuses.id', 'users.status_id')
        ->select('users.*', 'statuses.status')
        ->get()
        ->join('activities','activities.id', 'users.activity_id')
        ->select('activities.activity')
        ->get()
        ->join('genders','genders.id', 'users.gender_id')
        ->select('genders.gender')
        ->get();
        $data = [$users, $act, $gend];
        return $data; */

        /* $users = User::with('status', 'activity', 'gender')->get(); */
        
        return $users;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showuser($id)
    {
        return User::where('id', $id)->first();
        
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroyuser($id)
    {
        User::where('id', $id)->delete();

        return User::all();
    }

    public function updateuser(UserUpdateRequest $request, $id)
    {
        $validator=$request->validated();

        if ($validator) {
            $data = $request->all();
            $image = $request->file('image');
            $path = Storage::disk('public')->put('image', $image);
            if ($path) {
                $user = User::where('id', $id)->first();
                $user->image = $path;
                $user->first_name = $data['first_name'];
                $user->last_name = $data['last_name'];
                $user->birth = $data['birth'];
                $user->weight = $data['weight'];
                $user->height = $data['height'];
                $user->blood = $data['blood'];
                $user->gender_id = $data['gender_id'];
                $user->status_id = $data['status_id'];
                $user->activity_id = $data['activity_id'];
                $user->email = $data['email'];
                $user->password = bcrypt($data['password']);
                $user->phone = $data['phone'];
                $user->save();

                return response()->json(['status' => 200, 'user' => $user]);
            } else {
                return response()->json(['staus' => 500, 'error' => "couldnt upload image"]);
            }
        }
    }



    //////// admin


    /**
      * Display a listing of the resource.
      *
      * @return \Illuminate\Http\Response
      */
    public function index()
    {
        $admin=$this->adminRepository->display();
        return response()->json($admin);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $admin=$this->adminRepository->view($id);
        return response()->json($admin);
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        $admin=$this->adminRepository->delete($id);
        return response()->json([
            'message' => ' Admin deleted'
        ]);
    }



    /**
     * Register a admin.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(AdminRegisterRequest $request)
    {
        $validator=$request->validated();

        if ($validator) {
            $admin=$this->adminRepository->register($request);
            return response()->json([
            'admin'  => $admin,
            "message" =>"Admin succefully registered"
        ], 200);
        }
        return response()->json([
        "message" =>"Invalid info, couldn't Register"
    ], 401);
    }
     

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(AdminUpdateRequest $request, $id)
    {
        $validator=$request->validated();


        if ($validator) {
            $admin=$this->adminRepository->update($request, $id);
            

            return response()->json(['status' => 200, 'admin' => $admin]);
        }
    }



    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(AdminLoginRequest $request)
    {
        $validator=$request->validated();

        if (!$validator) {
            return response()->json($validator->errors(), 422);
        }

        if (!$token = auth()->attempt($validator)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->createNewToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function profile()
    {
        return $this->adminRepository->profile();
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        return $admin=$this->adminRepository->logout();
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->createNewToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    public function verifytokens()
    {
        return response()->json(['message' => 'Verified']);
    }
}