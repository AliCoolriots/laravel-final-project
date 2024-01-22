<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Developer;
use App\Models\Progress;
use App\Models\Project;

class DeveloperController extends Controller
{

    public function index()
    {
        $loggedInUserId = auth()->user()->user_id;
        $developer = Developer::with(['projects', 'leadingProjects'])->find($loggedInUserId);

        $developerProjects = $developer->projects->merge($developer->leadingProjects);

        $activeProjects = [];
        $completedProjects = [];

        foreach($developerProjects as $project)
        {
            if($project->status == 'completed')
                array_push($completedProjects, $project);
            else
                array_push($activeProjects, $project);
        }

        $path = 'developer';

        return view('mutual.projects',compact('developer','activeProjects', 'completedProjects','path'));
    }

    public function showProfile()
    {
        $user = auth()->user();
        $role = 'Developer';
        return view('auth.profile',compact('user','role'));
    }


    public function projectDetails($id)
    {
        $project = Project::with('developers')->find($id);
        $path = 'developer';

        if (!$project)
            abort(404); 

        return view('mutual.project-details',compact('project','path'));
    }


    public function showProgress($id)
    {
        $loggedInUserId = auth()->user()->user_id;
        $progress = Progress::where('project_id',$id)->get();
        $actualProject = Project::where('id', $id)->first();
        $project = Project::where('id', $id)
        ->whereHas('developers', function ($query) use ($loggedInUserId) {
            $query->where('developer_id', $loggedInUserId);
        })
        ->first();

        $path = 'developer'; 

        if (!$project && $actualProject->leader_developer_id != $loggedInUserId)
            abort(404); 
        
        $project =  $actualProject;

        return view('mutual.progress',compact('project','progress','loggedInUserId','path'));
    }

    public function createProgress($id)
    {
        $loggedInUserId = auth()->user()->user_id;
        $project = Project::where('id', $id)->first(); 

        if (!$project || $project->status == 'completed' || $project->leader_developer_id != $loggedInUserId )
            abort(404); 

        return view('developer.create-progress',compact('project'));
    }

    public function storeProgress(Request $request, $id)
    {
        $loggedInUserId = auth()->user()->user_id;
        $project = Project::where('id', $id)->first(); 

        if (!$project || $project->leader_developer_id != $loggedInUserId || $project->status == 'completed' )
            abort(404); 

        Progress::create([
            'date' => $request->progress_date,
            'description' => $request->description,
            'project_id' => $id,
            'leader_developer_id' => $loggedInUserId,
        ]);

        $project->status = $request->status;
        $project->save();

        return redirect('developer/projects/'.$id.'/progress');
    }
    
    public function searchProjects(Request $request)
    {
        $loggedInUserId = auth()->user()->user_id;

        $developer = Developer::with(['projects', 'leadingProjects'])->find($loggedInUserId);

        $developerProjects = $developer->projects->merge($developer->leadingProjects);


        $query = $request->query('query');

        $projects = $developerProjects->filter(function ($project) use ($query) {
            return stripos($project->system_name, $query) !== false;
        });

        $activeProjects = [];
        $completedProjects = [];

        foreach($projects as $project)
        {
            if($project->status == 'completed')
                array_push($completedProjects, $project);
            else
                array_push($activeProjects, $project);
        }

        $path = 'developer';

        return view('mutual.projects',compact('developer','activeProjects','completedProjects','path'));
    }
   
}
