<?php

namespace App\Observers;


use App\Models\ProjectServer;

class ProjectServerObserver
{
    //

    // creating, created, updating, updated, saving,
    // saved,  deleting, deleted, restoring, restored

    public function created(ProjectServer $projectserver)
    {

        $project=$projectserver->project;
        $project->price=$project->server->sum('price');
        $project->total_cpu=$project->server->sum('v_cpu');
        $project->total_memory=$project->server->sum('v_memory');
        $project->total_server=$project->server->count('v_cpu');
        $project->total_storage=$project->server->count('total_storage');
        $project->save();

    }

    public function saving(ProjectServer $projectserver)
    {

        $project=$projectserver->project;
        $project->price=$project->server->sum('price');
        $project->total_cpu=$project->server->sum('v_cpu');
        $project->total_memory=$project->server->sum('v_memory');
        $project->total_server=$project->server->count('v_cpu');
        $project->total_storage=$project->server->count('total_storage');
        $project->save();

    }

}
