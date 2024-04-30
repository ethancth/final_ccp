<?php

namespace App\Livewire;

use App\Models\Project;
use Livewire\Component;

class ProjectDocument extends Component
{
    public $project , $capacity_note,$license_note,$work_order_note,$capacity_check,$work_order_check,$license_check;

    public function mount($project){

        $this->project=$project;

        $this->capacity_note=$project->capacity_note;
        $this->capacity_check=$project->capacity_check;

        $this->work_order_note=$project->work_order_note;
        $this->work_order_check=$project->work_order_check;

        $this->license_note=$project->license_note;
        $this->license_check=$project->license_check;


    }
    public function render()
    {
        //dump($this->project);
        return view('livewire.project-document');
    }

    public function checkabletosubmit(){

        return false;
    }

    public function store()
    {
        //on form submit validation
        $this->validate([
           // 'capacity_note' => 'required|max:100|min:5|unique:service_applications,name,'.$this->edit_id.',id,tenant_id,'.Auth::user()->current_team_id,
            'license_note' => 'required|max:256|min:5',
            'license_check' => 'required|in:0,1',

                'capacity_note' => 'required|max:256|min:5',
                'capacity_check' => 'required|in:0,1',

                'work_order_note' => 'required|max:256|min:5',
                'work_order_check' => 'required|in:0,1',
        ]
            ,

            [
                'license_check.in' => 'The licence check field is required.',
                'license_note.required' => 'The  licence note is required.',
                'capacity_check.in' => 'The capacity check field is required.',
                'capacity_note.required' => 'The capacity note is required.',
                'work_order_check.in' => 'The work order check field is required.',
                'work_order_note.required' => 'The work order note is required.',
            ]
        );



        $record=Project::updateOrCreate(
            [
                'id' => $this->project->id,
            ],
            [
                'license_check' => $this->license_check,
                'license_note' => $this->license_note,
                'capacity_check' => $this->capacity_check,
                'capacity_note' => $this->capacity_note,
                'work_order_check' => $this->work_order_check,
                'work_order_note' => $this->work_order_note,


            ]
        );

        $this->dispatch('swal:modal',[
            'type'=>'success',
            'title'=>'Successfully Update Document',
            'text'=>'',
            'url'=>'/project/'.$this->project->id.'/'.$this->project->title,
        ]);
            $_store_status='Updated';

    }
}
