<?php

namespace App\Http\Controllers;

use App\Http\Requests\userRequest;
use App\Http\Resources\UserResource;
use App\Models\Poem;
use App\Models\Profile;
use App\Models\projects;
use App\Models\services;
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

            return back()
                ->with('error', 'البريد الإلكتروني أو كلمة المرور غير صحيحة')
                ->withInput();
        }


        $request->session()->regenerate();


        return redirect()->route('dashboard.index');
    }

    public function getAllProject()
    {
        // $projects_id = Auth::user()->projects()->get();
        $projects = projects::all();

        return view('components.projects', compact('projects'));
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
    public function showAll()
    {
        $userData = User::with('profile')->with('projects')->with('services')->first();
        return view('components.hero', compact('userData'));
    }

    public function logout(Request $request)
{
     Auth::logout();

    // 2. إبطال الجلسة الحالية لضمان الأمان
    $request->session()->invalidate();

    // 3. إعادة إنتاج CSRF Token لحماية الطلبات القادمة
    $request->session()->regenerateToken();

    // 4. إعادة التوجيه إلى صفحة تسجيل الدخول أو الرئيسية
    return redirect()->route('login')->with('success', 'تم تسجيل الخروج بنجاح!');
}
}
