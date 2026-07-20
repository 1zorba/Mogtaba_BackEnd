<?php

namespace App\Http\Controllers;

use App\Models\contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function sendMessage(Request $request)
    {
        // 1. التحقق من البيانات
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'email' => 'required|email',
                'contentMessage' => 'required|string',
                'subjects' => 'subjects|string',
            ]
        );
        $createMess = contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'contentMessage' => $request->contentMessage,
            'subjects' => $request->subjects,
        ]);
        return response()->json(['message' => 'success'], 200);
    }


    public function getMessages()
    {
        $mess = contact::all();
        return response()->json(['message' => $mess], 200);
    }

    public function Delete(int $id)
    {

        $mess = contact::where('id', $id);
        $mess->delete();
        return response()->json(['message' => 'Delete successfully'], 200);
    }
}
