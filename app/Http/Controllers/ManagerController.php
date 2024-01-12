<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manager;
use App\Models\Request as RequestModel;
use App\Models\Project;
use App\Models\Developer;

class ManagerController extends Controller
{
    public function index()
    {
        $loggedInUser = auth()->user(); 
        $loggedInUserId = auth()->user()->manager_id;
 
        $manager = Manager::where('id', $loggedInUserId)->first();
        // $projects = Project::all();
        return view('manager.index',compact('manager'));
    }

    public function viewRequest()
    {
        $loggedInUser = auth()->user(); 
        $loggedInUserId = auth()->user()->manager_id;
 
        $manager = Manager::where('id', $loggedInUserId)->first();
        return view('manager.view-request',compact('manager'));
    }

    public function storeProject(Request $request)
    {

        // echo $request;

        // $validatedData = $request->validate([
        //     'sytem_name' => 'required|string',
        //     'bu_name' => 'required|string',
        //     'system_pic' => 'required|string',
        //     'start_date' => 'required|date',
        //     'duration' => 'required|numeric',
        //     'end_date' => 'required|date',
        //     'status' => 'required|string|in:ahead_of_schedule,on_schedule,delayed,completed',
        //     'development_methodology' => 'required|string',
        //     'system_platform' => 'required|string',
        //     'deployment_type' => 'required|string',
        //     'leader_developer_id' => 'required|exists:developers,id',
        //     'developers' => 'required|array',
        //     'developers.*' => 'exists:developers,id',
        // ]);

    
        $project = Project::create([
            'system_name' => $request['system_name'],
            'bu_name' => $request['bu_name'],
            'system_pic' => $request['system_pic'],
            'start_date' => $request['start_date'],
            'duration' => $request['duration'],
            'end_date' => $request['end_date'],
            'status' => $request['status'],
            'development_methodology' => $request['development_methodology'],
            'system_platform' => $request['system_platform'],
            'deployment_type' => $request['deployment_type'],
            'request_status' => 'complteded',
            'system_id' => 1,
            'leader_developer_id' => $request['leader_developer_id'],
        ]);

        $project->developers()->attach($request['developers']);

        echo $project;

        // $project->save();

        return redirect('projects');
    
    }

    public function viewProjects()
    {
        $loggedInUser = auth()->user(); 
        $loggedInUserId = auth()->user()->manager_id;
        $projects = Project::all();
        $manager = Manager::where('id', $loggedInUserId)->first();
        return view('manager.projects',compact('manager','projects'));
    }

    public function createProject()
    {
        $loggedInUser = auth()->user(); 
        $loggedInUserId = auth()->user()->manager_id;
        $developers = Developer::all();
        $manager = Manager::where('id', $loggedInUserId)->first();
        return view('manager.create-project',compact('manager','developers'));
    }
}
