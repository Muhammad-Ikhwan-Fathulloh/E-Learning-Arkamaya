<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LiveHome extends Component
{
    public function render()
    {
        return view('livewire.live-home')->layout('home');
    }
}
