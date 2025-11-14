<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Services\TaskService;
use App\Models\Task;
use App\Models\Project;

class TaskServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_creates_task()
    {
        $project = Project::factory()->create();

        $service = app(TaskService::class);

        $task = $service->create([
            'name'       => 'Test Task',
            'project_id' => $project->id
        ]);

        $this->assertDatabaseHas('tasks', [
            'name' => 'Test Task',
            'project_id' => $project->id
        ]);
    }

    public function test_reorders_tasks()
    {
        $service = app(TaskService::class);

        $task1 = Task::factory()->create(['priority' => 1]);
        $task2 = Task::factory()->create(['priority' => 2]);

        $service->reorder([$task2->id, $task1->id]);

        $this->assertEquals(1, $task2->fresh()->priority);
        $this->assertEquals(2, $task1->fresh()->priority);
    }
}

