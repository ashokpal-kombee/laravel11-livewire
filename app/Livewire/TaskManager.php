<?php

namespace App\Livewire;

use Livewire\Component;

class TaskManager extends Component
{
    public $tasks = [
        ['id' => 1, 'title' => 'Learn Laravel Livewire', 'completed' => false],
        ['id' => 2, 'title' => 'Build a Livewire project', 'completed' => false],
    ];

    // Listen for the event emitted from the child component
    protected $listeners = ['taskCompleted'];

    public function taskCompleted($taskId)
    {
        $this->tasks = collect($this->tasks)->map(function ($task) use ($taskId) {
            if ($task['id'] === $taskId) {
                $task['completed'] = true;
            }
            return $task;
        })->toArray();
    }

    public function render()
    {
        return view('livewire.task-manager');
    }
}
