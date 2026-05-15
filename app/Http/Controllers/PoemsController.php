<?php

namespace App\Http\Controllers;

use App\Http\Requests\poemRequest;
use App\Models\Poem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class PoemsController extends Controller
{
    public function store(Request $request)
    {
        try {
            // معالجة مرنة: إذا أرسل الفرونت 'title' أو 'poem_title' يتم قبولهما
            $request->validate([
                'poem_title'   => 'required_without:title|string',
                'title'        => 'required_without:poem_title|string',
                'poem_content' => 'required_without:content|string',
                'content'      => 'required_without:poem_content|string',
                'image'        => 'nullable|image|max:2048',
                'poem_link'    => 'nullable|string',
            ]);

            // التأكد من أن المستخدم مسجل دخول ولا يسبب خطأ 500
            if (!auth()->check()) {
                return response()->json(['error' => 'غير مصرح لك، التوكن مفقود أو انتهت صلاحيته'], 401);
            }

            $path = null;
            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('poems_covers', 'public');
            }

            // التقاط الحقول ديناميكياً سواء أرسلها الفرونت بـ سابقة poem_ أم بدونها
            $poem = Poem::create([
                'user_id'      => auth()->id(),
                'poem_title'   => $request->poem_title ?? $request->title,
                'poem_content' => $request->poem_content ?? $request->content,
                'image'        => $path,
                'poem_link'    => $request->poem_link,
            ]);

            return response()->json(['message' => 'تم بنجاح', 'data' => $poem], 201);

        } catch (ValidationException $e) {
            // الـ Validation يجب أن يرجع 422 لكي يفهمه الفرونت إيند ولا ينهار بـ 500
            return response()->json(['error' => 'خطأ في التحقق من البيانات', 'messages' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function index()
    {
        // حماية مسبقة قبل جلب البيانات
        if (!auth()->check()) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }

        $poems = Poem::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        // توحيد الرد ليكون متوافقاً مع توقعات الفرونت إيند (response.data.data)
        return response()->json([
            'status' => 'success',
            'data'   => $poems
        ]);
    }

    public function show()
    {
        // دالة الهيرو العامة - جلب الكل بدون شروط حماية
        $poems = Poem::orderBy('created_at', 'desc')->get();
        return response()->json([
            'status' => 'success',
            'data'   => $poems // تم تعديلها من 'message' إلى 'data' لتوحيد الهيكلية مع الداشبورد
        ]);
    }

    public function destroy($id)
    {
        if (!auth()->check()) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }

        $poem = Poem::where('user_id', auth()->id())->where('id', $id)->first();

        if ($poem) {
            if ($poem->image) {
                Storage::disk('public')->delete($poem->image);
            }
            $poem->delete();
            return response()->json(['message' => 'تم الحذف بنجاح']);
        }

        return response()->json(['message' => 'القصيدة غير موجودة'], 404);
    }

    public function UpdatePoem(poemRequest $request, $id)
    {
        if (!auth()->check()) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }

        $poem = Poem::where('user_id', auth()->id())->where('id', $id)->first();

        if (!$poem) {
            return response()->json(['message' => 'القصيدة غير موجودة'], 404);
        }

        $data = $request->validated();
        if ($request->hasFile('image')) {
            if ($poem->image) {
                Storage::disk('public')->delete($poem->image);
            }
            $path = $request->file('image')->store('poems_covers', 'public');
            $data['image'] = $path;
        } else {
            unset($data['image']);
        }

        $poem->update($data);
        return response()->json(['message' => 'تم التحديث بنجاح', 'data' => $poem]);
    }
}