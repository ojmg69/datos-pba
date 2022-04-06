<?php

namespace App\Http\Livewire;

use Livewire\Component;

class MedioambientePlanesOPDS extends Component
{

    public $visual;

    public function mount($visual){
        $this->visual = $visual;
    
    }
    
    public function render()
    {
        return view('livewire.medioambiente-planes-o-p-d-s');
    }
}
