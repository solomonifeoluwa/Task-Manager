<?php

namespace App\Repositories\Eloquent;

use App\Models\Task;
use App\Repositories\TaskRepositoryInterface;

class TaskRepository implements TaskRepositoryInterface
{
    public function getByProject($projectId)
    {
        return Task::where('project_id', $projectId)
            ->orderBy('priority')
            ->get();
    }

    public function create(array $data)
    {
        $priority = Task::where('project_id', $data['project_id'])
            ->max('priority') + 1;

        return Task::create([
            'name' => $data['name'],
            'project_id' => $data['project_id'],
            'priority' => $priority,
        ]);
    }

    public function update($task, array $data)
    {
        return $task->update($data);
    }

    public function delete($task)
    {
        return $task->delete();
    }

    public function reorder(array $orderedIds)
    {
        foreach ($orderedIds as $index => $taskId) {
            Task::where('id', $taskId)->update(['priority' => $index + 1]);
        }
    }
}
