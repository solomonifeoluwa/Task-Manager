<?php

namespace App\Services;

use App\Models\Task;
use App\Repositories\TaskRepositoryInterface;

class TaskService
{
    public function __construct(
        private TaskRepositoryInterface $repository
    ) {}

    public function create($data)   { return $this->repository->create($data); }
    public function update($t,$d)   { return $this->repository->update($t,$d); }
    public function delete($t)      { return $this->repository->delete($t); }
    public function reorder($ids)   { return $this->repository->reorder($ids); }
    // public function create(array $data): Task
    // {
    //     $priority = Task::where('project_id', $data['project_id'])
    //         ->max('priority') + 1;

    //     return Task::create([
    //         'name' => $data['name'],
    //         'project_id' => $data['project_id'],
    //         'priority' => $priority,
    //     ]);
    // }

    // public function update(Task $task, array $data): Task
    // {
    //     $task->update($data);
    //     return $task;
    // }

    // public function delete(Task $task): void
    // {
    //     $task->delete();
    // }

    // public function reorder(array $orderedIds): void
    // {
    //     foreach ($orderedIds as $index => $taskId) {
    //         Task::where('id', $taskId)->update(['priority' => $index + 1]);
    //     }
    // }
}
