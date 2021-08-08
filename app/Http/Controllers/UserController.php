<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register (Request $request){
        $user = new User();
        $user -> name = $request->json("name");
        $user -> email = $request->json("email");
        $user -> password = Hash::make($request->json("password"));

        $email = User::where("email", "=", $request->json("email"))->first();
        if ($email){
            return response("email taken", 400);
        }
        $user->save();
        return response(new UserResource($user));

    }
    public function Login(Request $request){
        $user = User::where("email", "=", $request->json("email"))->first();
        if (!$user){
            return response("juzer ne postoji", 404);

        }
        $check = Hash::check($request->json("password"), $user->password);
        if ($check==false){

        return response("pasvord neispravan",400);
        }

        return response(new UserResource($user));

    }
}
