<?php

namespace App\Livewire;

use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AssignInfra extends Component
{

    public $selected_server;
    public $environment;
    public $tier;
    public $forms;
    public $project;
    public $demodata;


    public function demo(){
        $this->dispatch('get-server');
    }

    public function demo2(){
        dump($this->selected_server);
    }

    public function mount()
    {
        $this->forms= Company::with('envform','tierform','osform','saform')->where('id','=',Auth::user()->company->id)->get();
    }
    public function render()
    {
        return view('livewire.assign-infra');
    }

    public function storeInfra()
    {
     dump($this);
    }
}
