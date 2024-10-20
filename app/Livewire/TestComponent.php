<?php

namespace App\Livewire;

use Livewire\Component;

class TestComponent extends Component
{
    public $name = 'nba';
    public function render()
    {
        return view('livewire.test-component');
    }
}
