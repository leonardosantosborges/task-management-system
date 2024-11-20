<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    public function test_register_with_valid_role_user()
    {
        $data = [
            'name' => 'Leo Borges',
            'email' => 'leo@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'role' => 'user',
        ];

        $response = $this->post('/register', $data);

        $response->assertRedirect('/dashboard');

        $this->assertDatabaseHas('users', [
            'email' => 'leo@example.com',
            'role' => 'user',
        ]);
    }


    public function test_register_with_valid_role_admin()
    {
        $data = [
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'role' => 'admin',
        ];

        $response = $this->post('/register', $data);

        $response->assertRedirect('/dashboard');

        $this->assertDatabaseHas('users', [
            'email' => 'admin@example.com',
            'role' => 'admin',
        ]);
    }


    public function test_register_with_invalid_role()
    {
        $data = [
            'name' => 'Leo Borges',
            'email' => 'leo@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'role' => 'invalid',
        ];

        $response = $this->post('/register', $data);

        $response->assertSessionHasErrors(['role']);
    }

    public function test_register_without_role()
    {
        $data = [
            'name' => 'User Without Role',
            'email' => 'nowrole@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        $response = $this->post('/register', $data);

        $response->assertSessionHasErrors(['role']);
    }
}
