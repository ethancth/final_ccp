<?php

namespace App\Observers;
use App\Handlers\SlugHandler;
use App\Jobs\TranslateSlug;
use App\Models\Project;
use App\Models\ProjectJourney;


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
}
