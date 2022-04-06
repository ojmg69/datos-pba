<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Discapacidad extends Component
{
    public $visual;

    public function mount($visual){
        $this->visual = $visual;
    
    }
    public function render()
    {
        return view('livewire.discapacidad');
    }
}