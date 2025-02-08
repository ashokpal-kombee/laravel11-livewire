<?php

namespace App\Livewire;

use Livewire\Component;

class TaskItem extends Component
{
    public $task;

    public function markAsCompleted()
    {
        // Emit the event directly to the parent
        $this->dispatch('taskCompleted', $this->task['id']);
    }

    public function render()
    {
        return view('livewire.task-item');
    }
}
