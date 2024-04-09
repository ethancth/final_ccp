<?php

namespace App\Livewire;

use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CreateServerModal extends Component
{


    public $forms, $project;

    public $hostname;


    public function mount(){

        $this->forms= Company::with('envform','tierform','osform','saform')->where('id','=',Auth::user()->company->id)->get();

    }

    public function spec_validation()
    {


        //on form submit validation
        $this->validate([
            'hostname' => 'required|max:15|min:5|unique:project_servers,hostname',
        ],

            [
                'hostname.required' => 'The hostname field is required.',
                'hostname.min' => 'Server  hostname Should be Minimum of 5 Character.',
                'hostname.max' => 'Server hostname Must not be greater than 15 characters.',
                'hostname.unique' => 'Server hostname has already been taken.'
            ]
        );
        dump($this);
    }
    public function render()
    {
        return view('livewire.create-server-modal');
    }
}
