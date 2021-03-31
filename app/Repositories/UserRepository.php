<?php

namespace App\Repositories;
use Illuminate\Support\Facades\Storage;

use App\User;
use App\Cart;

use App\Response;

class UserRepository implements UserRepositoryInterface
{
    public function display()
    {
        
        
    }

    public function view($id)
    {
      

    }

    public function delete($id)
    {
        /* User::where('id', $id)->delete();
        return response()->json([
            'message' => 'User profile deleted'
        ]); */
    }
    public function update($request, $id)
    {
        $data = $request->all();
        $image = $request->file('image');
        $path = Storage::disk('public')->put('images', $image);
        if($path){
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

        }
        else {

            return response()->json(['staus' => 500, 'error' => "couldnt upload image"]);
        }
    }




    public function register($request)
    {
        $data = $request->all();
        $image = $request->file('image');
        $path = Storage::disk('public')->put('images', $image);
        if ($path) {
            $user = User::create([
        'image' => $path,
        'first_name' => $data['first_name'],
        'last_name' => $data['last_name'],
        'birth' => $data['birth'],
        'weight' => $data['weight'],
        'height' => $data['height'],
        'blood' => $data['blood'],
        'phone' => $data['phone'],
        'gender_id' => $data['gender_id'],
        'status_id' => $data['status_id'],
        'activity_id' => $data['activity_id'],
        'email'=>$data['email'],
        'password'=>bcrypt($data['password']),
        
         ]);
         if ($user) {
            $id= $user->id;
            $cart = Cart::create([
                'user_id' => $id,
            ]);
        }
         return response()->json(['status' => 200, 'user' => $user]);

        }
        else {

            return response()->json(['staus' => 500, 'error' => "couldnt upload image"]);
        }
        
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
        $user=auth()->user();
        
        // return response()->json(auth()->user());
        return Response::success($user, "Admin profile");
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $user=auth()->logout();
        $message="Successfully logged out";

        //return response()->json(['message' => 'Successfully logged out']);
        return Response::success($user, $message);
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