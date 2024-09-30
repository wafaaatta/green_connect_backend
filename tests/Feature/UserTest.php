<?php

namespace Tests\Feature;

use App\Models\Manager;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_fetch_users_is_not_public()
    {
        $this->getJson('/api/users')->assertStatus(403);
    }
    
    public function test_admin_can_fetch_users()
    {
        $manager = Manager::create([
            'name' => 'Manager',
            'email' => 'manager@manager',
            'password' => bcrypt('password'),
        ]);

        $this->postJson('/api/managers/login', [
            'email' => 'manager@manager',
            'password' => 'password',
        ]);

        $this->actingAs($manager)->getJson('/api/users')->assertStatus(200);
    }

    public function test_logged_in_user_cannot_fetch_other_users()
    {
        
        $user = User::create([
            'name' => 'User',
            'email' => 'user@user',
            'password' => 'password',
        ]);

        $this->postJson('/api/users/login', [
            'email' => 'user@user',
            'password' => 'password',
        ]);

        $this->actingAs($user)->getJson('/api/users')->assertStatus(403);
    }

    public function test_user_can_login()
    {
        $user = User::create([
            'name' => 'User',
            'email' => 'user@user',
            'password' => bcrypt('password'),
        ]);

        $this->postJson('/api/users/login', [
            'email' => 'user@user',
            'password' => 'password',
        ])->assertStatus(200);
    }
    
    public function test_login_with_wrong_password()
    {
        $user = User::create([
            'name' => 'User',
            'email' => 'user@user',
            'password' => 'password',
        ]);

        $this->postJson('/api/users/login', [
            'email' => 'user@user',
            'password' => 'wrong-password',
        ])->assertStatus(401)->dump();
    }
    
    public function test_register_with_password_meeting_requirements()
    {
        $this->postJson('/api/users', data: [
            'name' => 'User',
            'email' => 'user@user',
            'password' => 'shortdddA@23',
        ])->assertStatus(status: 201);
    }

    public function test_login_with_wrong_email()
    {
        $this->postJson('/api/users/login', [
            'email' => 'wrong-email',
            'password' => 'password',
        ])->assertStatus(404)->dump();
    }

    public function test_user_can_register()
    {
        $this->postJson('/api/users', [
            'name' => 'User',
            'email' => 'user@user',
            'password' => 'password',
        ])->assertStatus(201)->dump();
    }

    public function test_user_cannot_register_with_existing_email()
    {
        $exist_user = User::create([
            'name' => 'User',
            'email' => 'user@user',
            'password' => 'password',
        ]);
        
        $this->postJson('/api/users', [
            'name' => 'User',
            'email' => 'user@user',
            'password' => 'password',
        ])->assertStatus(422)->assertJsonValidationError('email')->dump();
    }

    public function test_delete_user()
    {
        $user = User::create([
            'name' => 'User',
            'email' => 'user@user',
            'password' => 'password',
        ]);
        $this->deleteJson("/api/users/{$user->id}")->assertStatus(204)->dump();
    }

    public function test_update_user()
    {
        $user = User::create([
            'name' => 'User',
            'email' => 'user@user',
            'password' => 'passwordA123@',
        ]);

        $this->postJson("/api/users/login", [
            'email' => 'user@user',
            'password' => 'passwordA123@',
        ]);

        $this->actingAs($user)->putJson("/api/users/{$user->id}", [
            'name' => 'Updated User',
        ])->assertStatus(200)->dump();
    }

    public function test_user_cannot_update_other_user()
    {
        $user = User::create([
            'name' => 'User',
            'email' => 'user@user',
            'password' => 'passwordA123@',
        ]);

        $this->postJson("/api/users/login", [
            'email' => 'user@user',
            'password' => 'passwordA123@',
        ]);

        $other_user = User::create([
            'name' => 'Other User',
            'email' => 'other@user',
            'password' => 'passwordA123@',
        ]);

        $this->actingAs($user)->putJson("/api/users/{$other_user->id}", [
            'name' => 'Updated User',
        ])->assertStatus(403)->dump();
    }
}