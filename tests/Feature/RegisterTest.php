<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Database\Seeders\UsersTableSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @param $name
     * @param $email
     * @param $password
     * @param $expectedStatusCode
     *
     * @return void
     * @dataProvider providerTestRegister
     */
    public function testRegister($name, $email, $password, $expectedStatusCode)
    {
        $this->seed(UsersTableSeeder::class);

        $response = $this->post('/api/v1/sign-in', [
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'password_confirmation' => $password,
        ], ['Accept' => 'application/json']);

        $response->assertStatus($expectedStatusCode);

        $this->assertDatabaseHas('users', ['name' => $name, 'email' => $email]);
    }

    /**
     * @dataProvider
     */
    public function providerTestRegister(): array
    {
        return [
            ['test', 'test@email.com', 'password', 204]
        ];
    }
}
