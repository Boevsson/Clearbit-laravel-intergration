<?php

namespace Tests\Feature;

use Tests\TestCase;
use Database\Seeders\UsersTableSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @param $email
     * @param $password
     * @param $expectedStatusCode
     *
     * @return void
     * @dataProvider providerTestLogin
     */
    public function testLogin($email, $password, $expectedStatusCode)
    {
        $this->seed(UsersTableSeeder::class);

        $response = $this->post('/api/v1/login', [
            'email' => $email,
            'password' => $password,
        ], ['Accept' => 'application/json']);

        $response->assertStatus($expectedStatusCode);
    }

    public function providerTestLogin(): array
    {
        return [
            ['admin@email.com', 'password', 200],
            ['fakeadmin@email.com', 'password', 422],
        ];
    }

    /**
     * @param $postData
     * @param $expectedContent
     *
     * @return void
     * @dataProvider providerTestLoginValidationFail
     */
    public function testLoginValidationFail($postData, $expectedContent)
    {
        $response = $this->post('/api/v1/login', $postData, ['Accept' => 'application/json']);

        $this->assertSame($expectedContent, $response->getContent());
        $response->assertStatus(422);
    }

    public function providerTestLoginValidationFail(): array
    {
        return [
            [['email' => 'admin@email.com'], '{"message":"The given data was invalid.","errors":{"password":["The password field is required."]}}'],
            [['password' => 'password'], '{"message":"The given data was invalid.","errors":{"email":["The email field is required."]}}'],
            [[], '{"message":"The given data was invalid.","errors":{"email":["The email field is required."],"password":["The password field is required."]}}'],
        ];
    }
}
