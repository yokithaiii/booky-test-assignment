<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class HttpRequestsTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_can_register()
    {
        $userData = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
        ];

        $response = $this->postJson(route('auth.register'), $userData);

        $response->assertStatus(201)
            ->assertJsonStructure(['message', 'user_id']);
    }

    public function test_can_login()
    {
        $loginData = [
            'email' => 'test@example.com',
            'password' => 'password',
        ];

        $response = $this->postJson(route('auth.login'), $loginData);

        $response->assertStatus(200)
            ->assertJsonStructure(['access_token', 'token_type', 'user_id']);
    }

    public function test_can_logout()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $response = $this->postJson(route('auth.logout'));

        $response->assertStatus(200)
            ->assertJsonStructure(['message']);
    }

    public function test_can_get_tasks()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $response = $this->getJson(route('task.index'));
        $response->assertStatus(200);
    }

    public function test_can_create_task_and_get_that()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $taskData = [
            'title' => 'Test Task',
            'description' => 'Test task description',
            'status' => 'pending',
        ];

        $response = $this->postJson(route('task.store'), $taskData);
        $response->assertStatus(201)
            ->assertJsonFragment($taskData);

        $taskId = $response->json('id');

        $tasksResponse = $this->getJson('/api/tasks/' . $taskId);
        $tasksResponse->assertStatus(200)
            ->assertJsonFragment(['title' => 'Test Task']);

    }

}
