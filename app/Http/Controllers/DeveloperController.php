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
        $developer = Developer::with('projects')->find($loggedInUserId);

        $leaderProjects = Developer::with('leadingProjects')->find($loggedInUserId);

        $developerProjects = $developer->projects->merge($leaderProjects->leadingProjects);


        return view('developer.index',compact('developer','developerProjects'));
    }

    public function projectDetails($id)
    {
        $project = Project::with('developers')->find($id);

        if (!$project)
            abort(404); 

        return view('developer.project-details',compact('project'));
    }


    public function viewProgress($id)
    {
        $loggedInUserId = auth()->user()->user_id;
        $progress = Progress::where('project_id',$id)->get();
        $project = Project::where('id', $id)->first(); 

        if (!$project)
            abort(404); 

        return view('developer.progress',compact('project','progress','loggedInUserId'));
    }

    public function createProgress($id)
    {
        $project = Project::where('id', $id)->first(); 

        if (!$project | $project->approved == 1)
            abort(404); 

        return view('developer.create-progress',compact('project'));
    }

    public function storeProgress(Request $request, $id)
    {
        $loggedInUserId = auth()->user()->user_id;
        $project = Project::where('id', $id)->first(); 

        

        if (!$project || $project->leader_developer_id != $loggedInUserId || $project->status == 'completed' )
            abort(404); 

        $progress = Progress::create([
            'date' => $request->date,
            'description' => $request->description,
            'project_id' => $id,
            'leader_developer_id' => $loggedInUserId,
        ]);

        $project->status = $request->status;
        $project->save();

        return redirect('developer/projects/'.$id.'/progress');
    }
    

    public function viewProfile()
    {
        $user = auth()->user();
        $role = 'Developer';
        return view('auth.profile',compact('user','role'));
    }
   
}
