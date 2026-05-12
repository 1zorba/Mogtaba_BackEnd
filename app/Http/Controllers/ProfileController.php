<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeProfile;
use App\Http\Requests\UpdateProfile;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    // public function store(storeProfile $request)
    // {
    //     $user_id = Auth::user()->id;
    //     // $user_id = User::find($user_id);

    //     $validateData = $request->validated();
    //     if ($request->hasFile('profile_image')) {
    //         $path = $request->file('profile_image')->store('profiles', 'public');
    //         $validateData['profile_image'] = $path;
    //     }
    //     $validateData['user_id'] = $user_id;

    //     $profile = profile::create($validateData);
    //     return response()->json($profile, 201);
    // }



    // public function update(Request $request)
    // {
    //     $user = $request->user();
    //     $profile = $user->profile;

    //     // تحديث البيانات النصية
    //     $profile->job_title = $request->job_title;
    //     $profile->bio = $request->bio;
    //     $profile->borrow = $request->borrow;
    //     $profile->phone = $request->phone;
    //     $profile->social_links = $request->social_links;
    //     $profile->cv_url = $request->cv_url;
    //     $profile->social_links2 = $request->social_links2;



    //     if ($request->hasFile('profile_image')) {

    //         $path = $request->file('profile_image')->store('profiles', 'public');

    //         $profile->profile_image = $path;
    //     }

    //     $profile->save();

    //     return response()->json([
    //         'message' => 'تم تحديث البروفايل بنجاح',
    //         'data' => $profile
    //     ]);
    // }

    public function update(Request $request)
{
    $user = Auth::user();

    // 1. التحقق من البيانات (يمكنك استخدام UpdateProfile request إذا أردت)
    $data = $request->validate([
        'job_title'     => 'nullable|string|max:255',
        'bio'           => 'nullable|string',
        'phone'         => 'nullable|string|max:20',
        'social_links'  => 'nullable|string',
        'social_links2' => 'nullable|string',
        'cv_url'        => 'nullable|url',
        'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // 2. معالجة الصورة
    if ($request->hasFile('profile_image')) {
        // تخزين الصورة في مجلد profiles داخل التخزين العام
        $path = $request->file('profile_image')->store('profiles', 'public');
        $data['profile_image'] = $path;
    }

    // 3. السحر هنا: التحديث إذا وجد السجل، أو الإنشاء إذا لم يجد
    // هذا يحل مشكلة "لم أنشئ بروفايل في الواجهة"
    $profile = $user->profile()->updateOrCreate(
        ['user_id' => $user->id], // شرط البحث (ابحث عن بروفايل بهذا الـ ID)
        $data                      // البيانات المراد حفظها أو تحديثها
    );

    return response()->json([
        'message' => $profile->wasRecentlyCreated ? 'تم إنشاء البروفايل بنجاح' : 'تم تحديث البروفايل بنجاح',
        'data' => $profile,
        // إضافة رابط الصورة الكامل ليسهل عرضه في React
        'image_url' => $profile->profile_image ? asset('storage/' . $profile->profile_image) : null
    ]);
}
}



