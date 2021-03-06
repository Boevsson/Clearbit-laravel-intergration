<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Database\Seeders\UsersTableSeeder;

class ForgottenPasswordTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic test example.
     *
     * @return void
     * @dataProvider providerTestForgottenPassword
     */
    public function testForgottenPassword($email, $expectedStatusCode, $expectedContent)
    {
        $this->seed(UsersTableSeeder::class);

        $response = $this->post('/api/v1/forgotten', [
            'email' => $email,
        ], ['Accept' => 'application/json']);

        $response->assertStatus($expectedStatusCode);
        $this->assertSame($expectedContent, $response->getContent());
    }

    public function providerTestForgottenPassword(): array
    {
        return [
            ['admin@email.com', 204, ''],
            ['test@email.com', 400, '{"error":{"email":"We can\'t find a user with that email address."},"code":400}'],
        ];
    }
}
