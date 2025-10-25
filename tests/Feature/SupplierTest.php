<?php

namespace Tests\Feature;

use App\Models\Supplier;
use App\Models\User;
use Tests\TestCase;

class SupplierTest extends TestCase
{
    public function test_supplier_get_list()
    {
        $user = User::first();
        $this->actingAs($user, 'api');
        $response = $this->get('/api/suppliers');

        $response->assertStatus(200)->assertJsonStructure([
            'data' => [
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'phone',
                        'contact_name',
                        'website',
                        'description',
                        'created_by',
                        'updated_by',
                        'created_at',
                        'updated_at',
                    ],
                ],
                'pagination' => [
                    'total',
                    'count',
                    'per_page',
                    'current_page',
                    'total_pages',
                    'last_page',
                ],
            ],
            'message',
            'timestamp',
            'success',
        ]);
    }
    /**
     * A basic feature test example.
     */
    public function test_supplier_create(): void
    {
        $user = User::first();
        $this->actingAs($user, 'api');

        $token = $user->createToken('Test token')->accessToken;
        $response = $this->postJson('/api/suppliers', [
            'name' => 'Test name',
            'phone' => '+998945784210',
            'contact_name' => 'Test contact',
            'website' => 'http://test.com',
            'description' => 'Test description',
        ]);
        $response->assertStatus(200);
        $this->assertNotNull(Supplier::latest()->first());

        $response = $this->postJson('/api/suppliers', [
            'name' => 157894,
            'phone' => '+998945784210',
            'contact_name' => 'Test contact',
            'website' => null,
            'description' => 'Test description',
        ]);
        $response->assertStatus(422);
    }

    public function test_supplier_update(): void
    {
        $user = User::first();
        $this->actingAs($user, 'api');

        $id = Supplier::latest('created_at')->value('id');
        $response = $this->putJson('/api/suppliers/' . $id, [
            'id' => $id,
            'name' => 'New test name',
            'phone' => '+998945784219',
            'contact_name' => 'New test contact',
            'website' => 'http://newtest.com',
            'description' => 'New test description',
        ]);

        $response->assertStatus(200);
    }

    public function test_supplier_delete(): void
    {
        $user = User::first();
        $this->actingAs($user, 'api');
        $id = Supplier::latest('created_at')->value('id');
        $response = $this->deleteJson('/api/suppliers/' . $id);

        $response->assertStatus(200);
    }
}
