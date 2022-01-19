<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Database\Seeders\UsersTableSeeder;

class CompanyRequestTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testSaveCompanyRequest()
    {
        $this->seed(UsersTableSeeder::class);

        $user = User::find(1);

        $response = $this->actingAs($user, 'api')->post('/api/v1/company', [
            'company_name' => 'Google',
            'company_domain' => 'google.com',
        ], ['Accept' => 'application/json']);

        $response->assertStatus(200);
        $this->assertSame('"The request is stored and will be processed as soon as possible"', $response->getContent());
    }
}
