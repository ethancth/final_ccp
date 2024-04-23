<?php

namespace App\Livewire;

use App\Http\Controllers\UserPageController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class HomeTheme extends Component
{
    public $home_theme,$home_theme_style;

    public function mount(){
        $this->home_theme=Auth::User()->theme;

        if(Auth::User()->theme==='dark'){
            $this->home_theme_style='sun';
        }else{
            $this->home_theme_style='moon';
        }
    }

    public function updatetheme(){
        if(Auth::User()->theme==='dark'){
            $new_theme='light';
        }else{
            $new_theme='dark';
        }

        User::updateOrCreate(
            [
                'id' => Auth::id(),
            ],
            [
                'theme' => $new_theme
            ]);
    }
    public function render()
    {
        return view('livewire.home-theme');
    }
}
