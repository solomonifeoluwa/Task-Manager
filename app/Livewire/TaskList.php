<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Task;
use App\Services\TaskService;

class TaskList extends Component
{
    public $tasks = [];
    public $projectId;

    protected $listeners = ['taskReordered' => 'reorderTasks'];

    public function mount($projectId = null)
    {
        $this->projectId = $projectId;

        if (!$this->projectId) {
            $this->tasks = [];     // prevents error
            return;
        }

        $this->loadTasks();
    }

    public function loadTasks()
    {
        $this->tasks = Task::where('project_id', $this->projectId)
            ->orderBy('priority')
            ->get();
    }


    public function reorderTasks($order)
    {
        app(TaskService::class)->reorder($order);
        $this->loadTasks();
    }

    public function render()
    {
        return view('livewire.task-list');
    }
}
