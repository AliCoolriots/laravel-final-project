<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Owner;
use App\Models\System;
use App\Models\Request as RequestModel;

class OwnerController extends Controller
{

    public function index()
    {
        $loggedInUserId = auth()->user()->user_id;

        $owner = Owner::where('id', $loggedInUserId)->first();

        $systems = System::where('owner_id', $loggedInUserId)->get();

        $requests = RequestModel::where('owner_id', $loggedInUserId)->get();

        return view('owner.index',compact('owner','systems','requests'));
    }

    public function systemDetails($id)
    {
        $system = System::where('id', $id)->first(); 

        if (!$system)
            abort(404); 

        return view('owner.system-details',compact('system'));
    }

    public function createRequest()
    {
        return view('owner.create-request');
    }


    public function storeRequest(Request $request)
    {
        $loggedInUserId = auth()->user()->user_id;

        $newRequest = RequestModel::create([
            'system_name' => $request->system_name,
            'description' => $request->system_description,
            'type' => 'new',
            'status' => 'pending',
            'owner_id' => $loggedInUserId,
        ]);

        return redirect('owner/view-requests');
    }

    public function enhanceRequest($id) 
    {
        $system = System::where('id', $id)->first(); 
        
        if($system)
            return view('owner.enhance-request',compact('id', 'system'));
        else
            return redirect('owner');
    }

    public function storeEnhanceRequest(Request $request, $id)
    {
        $loggedInUserId = auth()->user()->user_id;

        $newRequest = RequestModel::create([
            'system_name' => $request->system_name,
            'description' => $request->system_description,
            'type' => 'enhancement',
            'status' => 'pending',
            'system_id' => $id,
            'owner_id' => $loggedInUserId,
        ]);

        return redirect('owner/view-requests');
    }

    public function viewRequests()
    {
        $loggedInUserId = auth()->user()->user_id;

        $requests = RequestModel::where('owner_id', $loggedInUserId)->get();

        return view('owner.view-requests',compact('requests'));
    }

    public function deleteRequest($id)
    {
        $request = RequestModel::where('id', $id)->first();

        if($request->status == 'pending')
            $request->delete();
        
        return redirect('owner/view-requests');
    }

    public function viewProfile()
    {
        $user = auth()->user();
        $role = 'Owner';
        return view('auth.profile',compact('user','role'));
    }

}
