<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\Task;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    public function test_store_task()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $data = [
            'titulo' => 'Arrumar quarto',
            'descricao' => 'Varrer e passar pano no chão do quarto',
        ];

        $response = $this->postJson('/tasks', $data);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'task' => [
                'title' => 'Arrumar quarto',
                'description' => 'Varrer e passar pano no chão do quarto',
                'status' => 'pending',
                'user_id' => $user->id,
            ]
        ]);
    }

    public function test_store_task_unauthenticated()
    {
        $data = [
            'titulo' => 'Arrumar quarto',
            'descricao' => 'Varrer e passar pano no chão do quarto',
        ];

        $response = $this->postJson('/tasks', $data);

        $response->assertStatus(401);
        $response->assertJson([
            'message' => 'Unauthenticated.'
        ]);
    }

    public function test_index_task()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        Task::create([
            'title' => 'Arrumar quarto',
            'description' => 'Varrer e passar pano no chão do quarto',
            'status' => 'pending',
            'user_id' => $user->id
        ]);

        Task::create([
            'title' => 'Limpar banheiro',
            'description' => 'Lavar a pia, espelho e o chão do banheiro',
            'status' => 'completed',
            'user_id' => $user->id
        ]);

        $response = $this->getJson('/tasks');

        $response->assertStatus(200);
        $response->assertJsonCount(2, 'tasks');
    }

    public function test_destroy_task()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $task = Task::create([
            'title' => 'Organizar armário',
            'description' => 'Dobrar roupas e organizar sapatos',
            'status' => 'pending',
            'user_id' => $user->id
        ]);

        $response = $this->deleteJson('/tasks/' . $task->id);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'message' => 'Tarefa excluída com sucesso.',
        ]);

        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }

    public function test_destroy_task_not_found()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->deleteJson('/tasks/999');

        $response->assertStatus(500);
        $response->assertJson([
            'success' => false,
            'message' => 'Erro ao excluir tarefa: No query results for model [App\\Models\\Task] 999'
        ]);
    }


    public function test_update_task()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $task = Task::create([
            'title' => 'Limpar geladeira',
            'description' => 'Retirar sujeira e organizar alimentos',
            'status' => 'pending',
            'user_id' => $user->id
        ]);

        $data = [
            'titulo' => 'Limpar cozinha',
            'descricao' => 'Lavar os armários e o fogão',
            'status' => 'completed',
        ];

        $response = $this->putJson('/tasks/' . $task->id, $data);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'message' => 'Tarefa atualizada com sucesso!',
        ]);

        $task->refresh();
        $this->assertEquals('Limpar cozinha', $task->title);
        $this->assertEquals('Lavar os armários e o fogão', $task->description);
        $this->assertEquals('completed', $task->status);
    }
}
