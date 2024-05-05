<?php

namespace App\Observers;
use App\Handlers\SlugHandler;
use App\Jobs\TranslateSlug;
use App\Mail\SubmitProject;
use App\Models\Project;
use App\Models\ProjectJourney;
use App\Models\ProjectSecurityGroup;
use App\Models\ProjectSecurityGroupEnv;
use Illuminate\Support\Facades\Mail;


// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class ProjectObserver
{
    //
    public function saving(Project $project)
    {
        if ( !$project->slug) {
            $project->slug = app(SlugHandler::class)->translate($project->title);
        }
        if ( ! $project->slug) {
            dispatch(new TranslateSlug($project));
        }

    }

    public function updated(Project $project)
    {

        if($project->status=='5')
        {
            if( $project->server->count() ==  $project->server->where('provision_status','=','Complete')->count())
            {
                $project->status=6;
                $project->save();
            }


        }



    }
}
