<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Owner;

class OwnerController extends Controller
{

    public function index()
    {
        $loggedInUser = auth()->user(); 
        $loggedInUserId = auth()->user()->owner_id;

        // $projects = Project::all();

        $owner = Owner::where('id', $loggedInUserId)->first();
        return view('owner.index',compact('owner'));
    }
}
