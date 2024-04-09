<?php

namespace App\Livewire;

use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CreateProject extends Component
{

    public $modal_title='Create Project';
    public $modal_title_description='Create New Project or BAU Project.';

    public  $title, $is_bau_project;

    public function render()
    {
        return view('livewire.create-project');
    }


    public function storeProject()
    {

        //on form submit validation
        $this->validate([
            'title' => 'required|max:100|min:5|unique:projects,title,NULL,id,owner,'  . auth()->id(),
        ],

            [
                'title.required' => 'The project name field is required.',
                'title.min' => 'Project Name Should be Minimum of 5 Character.',
                'title.max' => 'Project Name Must not be greater than 100 characters.',
                'title.unique' => 'Project Name has already been taken.'
            ]
        );

        //Add Data into Post table Data

        if($this->is_bau_project){
            $this->is_bau_project='bau';
        }else{
            $this->is_bau_project='new';
        }

        $project =Project::create([
            'title' =>$this->title,
            'status'=>1,
            'owner'=>Auth::id(),
            'updated_by'=>Auth::id(),
            'project_type'=> $this->is_bau_project,
            'company_id'=>Auth::user()->company_id,



        ]);

        $this->dispatch('closeModal');
        $this->title = '';
        //For hide modal after add posts success
        $this->dispatch('swal:modal',[
            'type'=>'success',
            'title'=>'Successfully Create Project',
            'text'=>$project->title,
            'url'=>'/project/'.$project->id.'/'.$project->title,
        ]);





    }
}
