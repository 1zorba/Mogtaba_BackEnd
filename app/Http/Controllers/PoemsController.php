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
    public function store(poemRequest $request)
    {
        // أضف try-catch لكي نعرف ما هو الخطأ الحقيقي لو فشل
        try {

            $validateData = $request->validated();
            $user_id = Auth::user()->id;
            $path = null;
            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('poems_covers', 'public');
            }
            $validateData['user_id'] = $user_id;
            $validateData['image'] = $path;
            $poem = Poem::create($validateData);

            return response()->json(['message' => 'تم بنجاح', 'data' => $poem], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function index()
    {

        $user_id = Auth::user()->id;
        // جلب القصائد الخاصة بالمستخدم الحالي فقط وترتيبها من الأحدث
        $poems = Poem::where('user_id', $user_id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'status' => 'success',
            'data'   => $poems
        ]);
    }

    //  public function index()
    // {

    //     $poems = Poem::latest()->get();


    //     return view('poems.index',
    //     compact('poems'));

    // }

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
        return view('components.poems', compact('poems'));
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
