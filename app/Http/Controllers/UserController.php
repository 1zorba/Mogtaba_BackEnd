<?php

namespace App\Http\Controllers;

use App\Http\Requests\userRequest;
use App\Http\Resources\UserResource;
use App\Models\projects;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function createUser(userRequest $Request)
    {
        $valiDate = $Request->validated();
        $user = User::create($valiDate);
        return response()->json($user);
    }

    public function login(Request $request)
    {
        $request->validate([

            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'user invalid, we can not find this user'], 401);
        }
        $user = User::where('email', $request->email)->FirstOrFail();
        $Token_user = $user->createToken('auth_Token')->plainTextToken;
        return response()->json(['message' => 'login successfully', 'User' => $user, 'Token' => $Token_user], 200);
    }

    public function getAllProject()
    {
        // $projects_id = Auth::user()->projects()->get();
        $projects_id = projects::all();
        return response()->json(['message' => $projects_id]);
    }

    public function getUserByResource()
    {
        $user_id = Auth::user()->id;
        $userData = User::with('profile')->with('projects')->with('services')->find($user_id);
        return new UserResource($userData);
    }
    public function getMyInfo()
    {

        $userData = User::with('profile')->with('projects')->with('services')->first();
        return new UserResource($userData);
    }
}
