<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Session;

class ComputedComponents extends Component
{
    //Default Session
    #[Session]
    public $search_val;

    //Custome Session
    #[Session(key: 'my-custom-key')]
    public $search;

    // Locked Properties
    /** @locked */
    public $protectedProperty = 'Sensitive Data';

    public $firstName = 'Developer';
    public $lastName = 'Olly';

    public function getFullNameProperty()
    {
        return "{$this->firstName} {$this->lastName}";
    }

    public function render()
    {
        return view('livewire.computed-components');
    }
}
