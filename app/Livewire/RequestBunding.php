<?php

namespace App\Livewire;

use Livewire\Component;

class RequestBunding extends Component
{
    public $todos;
 
    public function mount() {
        $this->todos = collect([
            'first',
            'second',
            str('third'),
        ]);
    }
    
    public function render()
    {
        return view('livewire.request-bunding');
    }
}
