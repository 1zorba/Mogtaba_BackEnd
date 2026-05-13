<?php

namespace App\Http\Controllers;

use App\Http\Requests\poemRequest;
use App\Models\Poem;
use App\Models\poems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PoemsController extends Controller
{
    public function store(Request $request)
    {
        // أضف try-catch لكي نعرف ما هو الخطأ الحقيقي لو فشل
        try {
            $request->validate([
                'poem_title'   => 'required|string',
                'poem_content' => 'required|string',
                'image'        => 'nullable|image|max:2048',
                'poem_link'    => 'nullable|string',
            ]);

            $path = null;
            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('poems_covers', 'public');
            }

            $poem = Poem::create([
                'user_id'      => auth()->id(), // تأكد أن التوكين مرسل بشكل صحيح
                'poem_title'   => $request->poem_title,
                'poem_content' => $request->poem_content,
                'image'        => $path,
                'poem_link'    => $request->poem_link,
            ]);

            return response()->json(['message' => 'تم بنجاح', 'data' => $poem], 201);
        } catch (\Exception $e) {
            // هذا السطر سيرسل لك رسالة الخطأ الحقيقية بدلاً من 500 صماء
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function index()
    {
        // جلب القصائد الخاصة بالمستخدم الحالي فقط وترتيبها من الأحدث
        $poems = Poem::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'status' => 'success',
            'data'   => $poems
        ]);
    }

    public function destroy($id)
    {
        $user_id = Auth::user()->id;
        $poem = Poem::where('user_id', $user_id)->where('id', $id)->first();

        if ($poem) {
            if ($poem->image) {
                Storage::disk('public')->delete($poem->image);
            }

            $poem->delete();
            return response()->json(['message' => 'تم الحذف بنجاح']);
        }

        return response()->json(['message' => 'القصيدة غير موجودة'], 404);
    }






    public function show()
    {
        $poems = Poem::all();
        return response()->json(['message' => $poems]);
    }




    public function UpdatePoem(poemRequest $request, $id)
    {
        $user_id = Auth::user()->id;
        $poem = Poem::where('user_id', $user_id)->where('id', $id)->first();

        if (!$poem) {
            return response()->json(['message' => 'القصيدة غير موجودة'], 404);
        }

        $data = $request->validated();
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($poem->image); // حذف القديمة

            // التخزين الفعلي ونقل     من tmp إلى المجلد الدائم
            $path = $request->file('image')->store('poems_covers', 'public');
            $data['image'] = $path; // هنا نخزن المسار الجديد "poems_covers/name.jpg"
        } else {
            unset($data['image']);
        }


        $poem->update($data);

        return response()->json(['message' => $poem]);
    }
}
