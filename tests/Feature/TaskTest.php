<?php

namespace Tests\Feature;

use App\Models\StatusHistory;
use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use HasFactory, DatabaseTransactions;

    public function test_to_see_all_tasks()
    {
        Task::factory(20)->create();

        $response = $this->get(route('tasks.index'))
            ->assertOk();

        $taskCount = $response->getOriginalContent()->getData()['tasks']->count();

        $this->assertEquals(20, $taskCount);
    }


    public function test_to_create_tasks()
    {
        $data = [
            'name' => 'Something',
            'description' => 'Anything',
            'status' => 'active'
        ];

        $this->post(route('tasks.store'), ['name' => ''])
            ->assertStatus(302);

        $this->post(route('tasks.store'), $data)
            ->assertRedirect(route('tasks.index'));


        $this->assertDatabaseHas('tasks', [
            'name' => 'Something',
            'description' => 'Anything',
            'status' => 'active'
        ]);


        $task = Task::query()->where('name', 'Something')->first();

        $this->assertNotNull($task);
        $this->assertCount(1, $task->statusHistories);

        $statusHistory = $task->statusHistories->first();
        $this->assertEquals('active', $statusHistory->status);
    }


    public function test_to_update_task()
    {
        $task = Task::factory()->create([
            'name' => 'Something',
            'status' => 'active'
        ]);

        $this->patch(route('tasks.update', $task->id), [
            'name' => 'Anything',
            'status' => 'completed',
            'description' => $task->description
        ])
            ->assertRedirect(route('tasks.index'));

        $taskUpdated = Task::query()
            ->where('status', 'completed')
            ->where('name', 'Anything')
            ->exists();

        $this->assertTrue($taskUpdated);

        $statusHistory = StatusHistory::query()->where('task_id', $task->id)
            ->where('status', 'completed')
            ->exists();

        $this->assertTrue($statusHistory);

    }


    public function test_to_delete_task()
    {

        $this->post(route('tasks.store'), [
            'name' => 'Anything',
            'status' => 'completed',
            'description' => 'description'
        ])->assertRedirect(route('tasks.index'));

        $task = Task::query()->latest()->first();


        $this->delete(route('tasks.destroy', $task->id))
            ->assertRedirect();

        $taskDeleted = Task::query()
            ->where('id', $task->id)
            ->doesntExist();

        $this->assertTrue($taskDeleted);

        $statusHistory = StatusHistory::query()->where('task_id', $task->id)
            ->doesntExist();

        $this->assertTrue($statusHistory);
    }


    public function test_to_to_test_status_filter()
    {
        Task::factory(10)->create([
            'status' => 'active'
        ]);

        Task::factory(11)->create([
            'status' => 'completed'
        ]);

        $response = $this->get(route('tasks.index', ['status' => 'active']))
            ->assertOk();

        $taskCount = $response->getOriginalContent()->getData()['tasks']->count();

        $this->assertEquals(10, $taskCount);
    }
}

