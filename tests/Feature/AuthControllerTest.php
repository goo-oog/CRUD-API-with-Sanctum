<?php
declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testLogin()
    {
        $user = User::factory()->create([
            'password' => password_hash('abcde', PASSWORD_BCRYPT)
        ]);
        $response = $this->postJson('api/auth/login', [
            'email' => $user->email,
            'password' => 'abcde'
        ]);
        $response->assertStatus(200);
        $response->assertJson([
            'status' => 'Success',
            'message' => ['Login was successful']
        ]);
        self::assertEquals(40, strlen($response->json('token')));

    }

    public function testLogout()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->postJson('api/auth/logout');
        $response->assertStatus(200);
        $response->assertJson([
            'status' => 'Success',
            'message' => ['All tokens revoked for user ' . $user->name]
        ]);
    }

    public function testMe()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->getJson('/api/me');
        $response->assertStatus(200);
        $response->assertJson([
            'name' => $user->name,
            'email' => $user->email
        ]);
    }

    public function testRegister()
    {
        $response = $this->postJson('api/auth/register', [
            'email' => 'test@example.com',
            'name' => 'TestName',
            'password' => 'abcde',
            'password_confirmation' => 'abcde'
        ]);
        $this->assertDatabaseHas('users', [
            'name' => 'TestName',
            'email' => 'test@example.com'
        ]);
        $response->assertStatus(200);
        $response->assertJson([
            'status' => 'Success',
            'message' => ['Registration was successful']
        ]);
        self::assertEquals(40, strlen($response->json('token')));
    }
}
