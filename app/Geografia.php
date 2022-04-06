<?php

namespace App\Http\Livewire;

use App\Clima;
use Livewire\Component;

class Geografia extends Component
{
    public $visual;
    public $clima;

    public function mount($visual){
        $this->visual = $visual;
        $this->clima = Clima::find(1)->nombre;
    }
    
    public function render()
    {
        return view('livewire.geografia');
    }
}
