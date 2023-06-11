<?php

namespace App\Observers;
use App\Handlers\SlugHandler;
use App\Jobs\TranslateSlug;
use App\Models\Project;
use App\Models\ProjectJourney;
use App\Models\ProjectSecurityGroup;
use App\Models\ProjectSecurityGroupEnv;


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
        if($project->status=='3')
        {
           //Project Create Security-Group
            $projectsg=$project->sg()->get();
            if($projectsg->isEmpty()){
                $query= ProjectSecurityGroup::firstOrCreate(
                    ['project_id' =>  $project->id],
                    ['slug' => "SG-".$project->slug]
                );

                $query->save();
            }

            $projectsg=$project->sg()->get();
            $_project_g=$projectsg[0]->env()->get();
            $alltier=$project->server()->select('display_tier')->distinct()->pluck('display_tier')->toArray();



            if($_project_g->isEmpty()){

                foreach ($alltier as $field){
                    $query= ProjectSecurityGroupEnv::firstOrCreate(
                        ['security_id' =>  $projectsg[0]->id,
                            'env' => $field,
                            'slug' => $projectsg[0]->slug.'-'.$field]

                    );
                }

//
                $query->save();
            }

        }

    }
}
