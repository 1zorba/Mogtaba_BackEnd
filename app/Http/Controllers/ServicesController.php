<?php

namespace App\Http\Controllers;

use App\Http\Requests\services;
use App\Http\Requests\Services_Update;
use App\Models\services as modelServices;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ServicesController extends Controller
{
    public function create_service(services $request) // استخدم Request العادي للتجربة أولاً
    {
        Auth::user()->id;
        $validateData = $request->validated();

        $validateData['user_id'] = Auth::user()->id;;
        $service = services::create($validateData);
        return response()->json(["message" => 'success created', "data" => $service], 201);
    }

    // أضف المتغير $id هنا
    public function update_services(Services_Update $request, $id)
    {
        $user_id = Auth::id();

        // ابحث عن الخدمة التي تحمل هذا الـ ID وتخص هذا المستخدم تحديداً
        $user_service = modelServices::where('id', $id)
            ->where('user_id', $user_id)
            ->first();

        if (!$user_service) {
            return response()->json(["message" => "الخدمة غير موجودة"], 404);
        }

        // جلب البيانات المفلترة من الـ Request
        $data = $request->validated();



        $user_service->update($data);

        return response()->json(['message' => $user_service]);
    }

    public function getAllServices()
    {
        $user_id = Auth::user()->id;
        $services = modelServices::where('user_id', $user_id)->get();
        return response()->json([$services]);
    }
    public function DeleteService($id)
    {
        $user_id = Auth::id();

        // البحث عن الخدمة والتأكد أنها تخص المستخدم
        $service = modelServices::where('user_id', $user_id)->where('id', $id)->first();



        // حذف السجل من قاعدة البيانات
        $service->delete();

        return response()->json(['message' => 'تم حذف الخدمة بنجاح!']);
    }
}
