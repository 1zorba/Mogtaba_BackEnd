<?php

namespace App\Http\Controllers;

use App\Models\User;

class HomeController extends Controller
{

    public function getData()
    {
        return User::with('profile')->with('projects')->with('services')->first();
    }
    public function index()
    {
        $userData = $this->getData();

        return view('pages.home', compact('userData'));
    }
    public function projects()
    {
        $userData = $this->getData();

        return view('components.projects', compact('userData'));
    }
    public function services()
    {
        $userData = $this->getData();

        return view('components.services', compact('userData'));
    }
 
}
