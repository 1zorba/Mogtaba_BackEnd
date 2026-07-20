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
    public function store(storeProfile $request)
    {
        $user_id = Auth::user()->id;

        $validateData = $request->validated();
        if ($request->hasFile('profile_image')) {
            $path = $request->file('profile_image')->store('profiles', 'public');
            $validateData['profile_image'] = $path;
        }
        $validateData['user_id'] = $user_id;

        profile::create($validateData);
        return response()->json(['message' => 'success'], 201);
    }




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
            'borrow'        => 'string|nullable',
            'cv_url'        => 'nullable|url',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // 2. معالجة الصورة
        if ($request->hasFile('profile_image')) {
            // تخزين الصورة في مجلد profiles داخل التخزين العام
            $path = $request->file('profile_image')->store('profiles', 'public');
            $data['profile_image'] = $path;
        }

        $profile = $user->profile()->updateOrCreate(
            ['user_id' => $user->id],
            $data
        );

        return response()->json([
            'message' => $profile->wasRecentlyCreated ? 'تم إنشاء البروفايل بنجاح' : 'تم تحديث البروفايل بنجاح',
            'data' => $profile,

        ]);
    }

}
