<?php

namespace App\Repositories;

use App\Admin;
use App\Response;

class AdminRepository implements AdminRepositoryInterface
{
    public function display()
    {
        return $admin = Admin::all();
    }

    public function view($id)
    {
        return Admin::where('id', $id)->first();
    }

    public function delete($id)
    {
        Admin::where('id', $id)->delete();
        return response()->json([
            'message' => 'Admin profile deleted'
        ]);
    }
    public function update($request, $id)
    {
        $data = $request->all();
        $admin = Admin::where('id', $id)->first();
        $admin->first_name = $data['first_name'];
        $admin->last_name = $data['last_name'];
        $admin->email = $data['email'];
        $admin->password = bcrypt($data['password']);
        $admin->phone =$data['phone'];
        $admin->save();
    }


    public function register($request)
    {
        $data = $request->all();
        $admin = Admin::create([
        'first_name' => $data['first_name'],
        'last_name' => $data['last_name'],
        'email'=>$data['email'],
        'phone'=>$data['phone'],
        'password'=>bcrypt($data['password']),
         ]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login($request)
    {
        
        //return $this->createNewToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function profile()
    {
        $admin=auth('admin')->user();
        
        // return response()->json(auth()->user());
        return Response::success($admin, "Admin profile");
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $admin=auth()->logout();
        $message="Successfully logged out";

        //return response()->json(['message' => 'Successfully logged out']);
        return Response::success($admin, $message);
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
    public function createNewToken($token)
    {
    }
}