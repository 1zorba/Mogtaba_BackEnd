<?php

namespace App\Http\Controllers;

use App\Http\Requests\contactRequest;
use App\Http\Requests\poemRequest;
use App\Http\Requests\projectsRequest;
use App\Http\Requests\services as RequestsServices;
use App\Http\Requests\userRequest;
use App\Models\contact;
use App\Models\Poem;
use App\Models\projects;
use App\Models\services;
use App\Models\User;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index()
    {
        // جلب الـ ID الخاص بالمستخدم الحالي مباشرة
        $user_id = Auth::id();

        // جلب مستخدم واحد فقط باستخدام find مع علاقة البروفايل
        $user = User::with('profile')->find($user_id);
        $projectsCount = projects::count();
        $poemsCount = Poem::count();
        $servicesCount = services::count();

        // تمرير المتغير باستخدام compact لتسمية المفتاح تلقائياً باسم المتغير 'user'
        return view('dashboard.index', compact('user', 'projectsCount', 'poemsCount', 'servicesCount'));
    }

    public function createProject(projectsRequest $request)
    {

        $user_id = Auth::user()->id;
        $validate = $request->validated();
        if ($request->hasFile('image_url')) {
            $path = $request->file('image_url')->store('image_projects', 'public');
            $validate['image_url'] = $path;
        }
        $validate['user_id'] = $user_id;

        $project = projects::create($validate);
        return response()->json(["message" => "created successfully", $project], 200);
    }


    public function projects()
    {
        // جلب مشاريع المستخدم المسجل حالياً فقط لتخصيص لوحة التحكم له
        $projects = projects::where('user_id', auth()->id())->latest()->get();

        // تمرير المشاريع إلى صفحة العرض
        return view('dashboard.projects', compact('projects'));
    }

    public function services()
    {
        $user_id = Auth::user()->id;
        $services = services::where('user_id', $user_id)->get();
        return view('dashboard.services', compact('services'));
    }

    public function create_service(RequestsServices $request) // استخدم Request العادي للتجربة أولاً
    {
        $validateData = $request->validated();

        $validateData['user_id'] = Auth::user()->id;
        $service = services::create($validateData);
        return response()->json(["message" => 'success created', "data" => $service], 201);
    }
    public function poems()
    {
        $user_id = Auth::user()->id;
        // جلب القصائد الخاصة بالمستخدم الحالي فقط وترتيبها من الأحدث
        $poems = Poem::where('user_id', $user_id)
            ->orderBy('created_at', 'desc')
            ->get();


        return view('dashboard.poems', compact('poems'));
    }
    public function contacts()
    {
        $message = contact::all();
        return view('dashboard.contacts', compact('message'));
    }
    public function StoreContact(contactRequest $request)
    {
        $data = $request->validated();
        contact::create($data);
        return response()->json(['message' => 'success'], 200);
    }



    public function storePoem(poemRequest $request)
    {

        $user_id = Auth::user()->id;
        $validate = $request->validated();
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('poems_covers', 'public');
            $validate['image'] = $path;
        }
        $validate['user_id'] = $user_id;
        $poem = Poem::create($validate);
        return response()->json(["message" => "created successfully", $poem], 200);
    }

    public function getUser()
    {
        // جلب الـ ID الخاص بالمستخدم الحالي مباشرة
        $user_id = Auth::id();

        // جلب مستخدم واحد فقط باستخدام find مع علاقة البروفايل
        $users = User::with('profile')->find($user_id);


        // تمرير المتغير باستخدام compact لتسمية المفتاح تلقائياً باسم المتغير 'user'
        return view('components.sidebar', compact('users'));
    }






    // public function getAllProject()
    // {
    //      $projects = projects::get();

    //     return view('components.projects', compact('projects'));
    // }
}
