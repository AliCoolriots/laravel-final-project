<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manager;
use App\Models\Request as RequestModel;
use App\Models\Project;
use App\Models\System;
use App\Models\Progress;
use App\Models\Developer;

class ManagerController extends Controller
{
    public function index()
    {
        $loggedInUserId = auth()->user()->user_id;
 
        $manager = Manager::where('id', $loggedInUserId)->first();
        $requests = RequestModel::where('status', 'pending')->get();

        return view('manager.index',compact('manager','requests'));
    }

    public function viewRequest($id)
    {
        $request = RequestModel::where('id', $id)->first(); 
        
        if($request && $request->status == 'pending')
            return view('manager.view-request',compact('request'));
        else
            return redirect('manager/');

    }

    public function createProject($id)
    {
        $developers = Developer::all();

        $request = RequestModel::where('id', $id)->first(); 
        
        if($request && $request->status == 'pending')
            return view('manager.create-project',compact('developers','id','request'));
        else
            return redirect('manager/');
    }


    public function storeProject(Request $request,$id)
    {
        // $validatedData = $request->validate([
        //     'system_name' => 'required|string',
        //     'owner_name' => 'required|string',
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

        $requestPending = RequestModel::where('id', $id)->first();  

        $developer = Developer::where('id',$request->leader_developer_id)->first();

        if(!$requestPending || $requestPending->status == 'approved')
            abort(404); 
    
        $project = Project::create([
            'system_name' => $request->system_name,
            'owner_name' => $request->owner_name,
            'system_pic' => $developer->name,
            'start_date' => $request->start_date,
            'duration' => $request->duration,
            'end_date' => $request->end_date,
            'status' => 'on_schedule',
            'development_methodology' => $request->development_methodology,
            'system_platform' => $request->system_platform,
            'deployment_type' => $request->deployment_type,
            'request_type' => $requestPending->type,
            'aprroved' => 0,
            'system_id' => $requestPending->system_id,
            'owner_id' => $requestPending->owner_id,
            'leader_developer_id' => $request->leader_developer_id,
        ]);
        
        $project->developers()->attach($request->developers);
        
        $requestPending->status = 'approved';

        $requestPending->save();

        return redirect('manager/projects');
    
    }

    public function viewProjects()
    {
        $activeProjects = Project::where('approved', 0)->get();
        $completedProjects = Project::where('approved', 1)->get();

        return view('manager.projects',compact('activeProjects','completedProjects'));
    }

    public function projectDetails($id)
    {
        $project = Project::with('developers')->find($id);

        if (!$project)
            abort(404); 

        return view('manager.project-details',compact('project'));
    }

    public function viewProgress($id)
    {
        $progress = Progress::where('project_id',$id)->get();
        $project = Project::where('id', $id)->first(); 

        if (!$project)
            abort(404); 

        return view('manager.progress',compact('project','progress'));
    }

    public function approveProject($id)
    {
        $project = Project::where('id', $id)->first(); 
        
        if($project->status == 'completed' && $project->approved == 0)
        {
            if($project->request_type == 'new')
            {
                $system = System::create([
                    'system_name' => $project->system_name,
                    'version' => 1,
                    'owner_id' => $project->owner_id,
                    'development_methodology' => $project->development_methodology,
                    'system_platform' => $project->system_platform,
                    'deployment_type' => $project->deployment_type,
                ]);
            }
            else
            {
                $system = System::where('id', $project->system_id)->first(); 
                $system->version = $system->version + 1;
                $system->save();
            }

            $project->approved = 1;
            $project->save();
        }

        return redirect('manager/projects');
    }

    public function editProject($id)
    {
        $project = Project::with('developers')->find($id);

        $developers = Developer::all();

        if (!$project || $project->approved == 1 ) 
            abort(404); 

        return view('manager.edit-project',compact('developers', 'project', 'id'));
       
    }

    public function updateProject(Request $request, $id)
    {
        $project = Project::find($id);

        if (!$project || $project->approved == 1 ) 
            abort(404); 

        $developer = Developer::where('id',$request->leader_developer_id)->first();

        $project->update([
            'system_name' => $request->system_name,
            'system_pic' => $developer->name,
            'start_date' => $request->start_date,
            'duration' => $request->duration,
            'end_date' => $request->end_date,
            'development_methodology' => $request->development_methodology,
            'system_platform' => $request->system_platform,
            'deployment_type' => $request->deployment_type,
            'leader_developer_id' => $request->leader_developer_id,
        ]);

        $project->developers()->sync($request->developers);

        return redirect('manager/projects/'.$id);
       
    }

    public function viewProfile()
    {
        $user = auth()->user();
        $role = 'Manager';
        return view('auth.profile',compact('user','role'));
    }
}

