<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Database\Seeders\UsersTableSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NewPasswordTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testNewPassword()
    {
        $this->seed(UsersTableSeeder::class);

        $newPassword = 'new-password';

        $user = User::find(1);

        $token = Password::broker()->createToken($user);

        $response = $this->post('/api/v1/change-password', [
            'email'                 => $user->email,
            'password'              => $newPassword,
            'password_confirmation' => $newPassword,
            'token'                 => $token,
        ], ['Accept' => 'application/json']);

        $response->assertStatus(204);

        $user = User::find(1);

        $this->assertTrue(Hash::check($newPassword, $user->password));
    }
}
