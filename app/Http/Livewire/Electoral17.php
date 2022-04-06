<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Electoral17 extends Component
{

    public $visual;

    public function mount($visual){
        $this->visual = $visual;
    
    }
    
    public function render()
    {
        return view('livewire.electoral17');
    }
}
