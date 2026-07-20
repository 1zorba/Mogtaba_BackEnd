<?php

namespace App\Http\Controllers;

use App\Http\Requests\projectsRequest;
use App\Http\Requests\UpadetProject;
use App\Models\projects;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProjectsController extends Controller
{
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


    
    public function showAllProjects()
    {
        $allProjects = projects::get();
        return view('compo', compact('allProjects'));
    }

    public function UpdateProject(UpadetProject $request, $id)
    {
        $user_id = Auth::user()->id;
        $project = projects::where('user_id', $user_id)->where('id', $id)->first();

        if (!$project) {
            return response()->json(['message' => 'المشروع غير موجود'], 404);
        }

        $data = $request->validated();
        if ($request->hasFile('image_url')) {
            // التخزين الفعلي ونقل     من tmp إلى المجلد الدائم
            $path = $request->file('image_url')->store('image_projects', 'public');
            $data['image_url'] = $path; // هنا نخزن المسار الجديد "image_projects/name.jpg"
        } else {
            unset($data['image_url']);
        }

        $project->update($data);

        return response()->json(['message' => $project]);
    }


    public function DeleteProject($id)
    {
        $user_id = Auth::user()->id;
        $project = projects::where('user_id', $user_id)->where('id', $id)->first();

        if ($project) {
            if ($project->image_url) {
                Storage::disk('public')->delete($project->image_url);
            }

            $project->delete();
            return response()->json(['message' => 'تم الحذف بنجاح']);
        }

        return response()->json(['message' => 'المشروع غير موجود'], 404);
    }


    public function manageProjectsPage()
    {
        // جلب مشاريع المستخدم الحالي فقط لحمايتها وتسهيل إدارتها
        $myProjects = projects::where('user_id', Auth::id())->get();

        return view('dashboard.projects.manage', compact('myProjects'));
    }
}
