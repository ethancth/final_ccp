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

        $_old_field=$project->getDirty();
        if( $project->status=='2')
        {
            //Submit
            $name ='Reject';
            Mail::to('testreceiver@gmail.com’')->send(new SubmitProject($name,$project));

        }
        if($project->status=='3')
        {
            //send Email



           //Project Create Security-Group
//            $projectsg=$project->sg()->get();
//            if($projectsg->isEmpty()){
//                $query= ProjectSecurityGroup::firstOrCreate(
//                    ['project_id' =>  $project->id],
//                    ['slug' => "SG-".$project->slug]
//                );
//
//                $query->save();
//            }
//
//            $projectsg=$project->sg()->get();
//            $_project_g=$projectsg[0]->env()->get();
//            $alltier=$project->server()->select('display_tier','display_env')->distinct()->pluck('display_tier','display_env')->toArray();
//
//            $project->status='2';
//            $project->save();
//
//            $projectsg[0]->env()->forceDelete();
//            if($_project_g->isEmpty()){
//
//                foreach ( $project->server()->get() as $field){
//                    $query= ProjectSecurityGroupEnv::firstOrCreate(
//                        ['security_id' =>  $projectsg[0]->id,
//                            'env' => $field->display_env.$field->display_tier,
//                            'slug' => $projectsg[0]->slug.'-'.$field->display_env.'-'.$field->display_tier,
//                            'scope'=> 'envtier'
//                        ]
//
//                    );
//                    $query->save();
//
//                    $query= ProjectSecurityGroupEnv::firstOrCreate(
//                        ['security_id' =>  $projectsg[0]->id,
//                            'env' => $field->display_env,
//                            'slug' => $projectsg[0]->slug.'-'.$field->display_env,
//                            'scope'=> 'env'
//                        ]
//
//                    );
//                    $query->save();
//
//                    $query= ProjectSecurityGroupEnv::firstOrCreate(
//                        ['security_id' =>  $projectsg[0]->id,
//                            'env' => $field->display_tier,
//                            'slug' => $projectsg[0]->slug.'-'.$field->display_tier,
//                            'scope'=> 'tier'
//                        ]
//
//                    );
//                    $query->save();
//
//
//                }
//
////
//            }
//
//            foreach ( $project->server()->get() as $field){
//
//                $sg_env= $project->sg->env()->where('env','=',$field->display_env)->first();
//                $sg_tier= $project->sg->env()->where('env','=',$field->display_tier)->first();
//                $sg_envtier= $project->sg->env()->where('env','=',$field->display_env.$field->display_tier)->first();
//
//                $sg_env->servers()->syncWithoutDetaching($field);
//                $sg_tier->servers()->syncWithoutDetaching($field);
//                $sg_envtier->servers()->syncWithoutDetaching($field);
//
//
//            }

            foreach ( $project->server()->get() as $data){
                $data->is_vm_provision =1;
                $data->save();
            }
            $project->status='5';
            $project->save();



        }


        //update price
//
//        $project->total_cpu=$project->server->sum('v_cpu');
//        $project->total_memory=$project->server->sum('v_cpu');
//        $project->total_server=$project->server->count('v_cpu');
//        $project->save();



    }
}
