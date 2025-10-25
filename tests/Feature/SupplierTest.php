<?php

namespace Tests\Feature;

use App\Models\Supplier;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class SupplierTest extends TestCase
{
    public function test_supplier_get_list()
    {
        $response = $this->get('/api/suppliers');

        $response->assertStatus(200)->assertJsonStructure([
            'data' => [],
            'message' => '',
            'status' => 200,
            'success' => true,
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
            'created_by' => 12
        ]);
        $response->assertStatus(422);
    }

    public function test_supplier_update(): void
    {
        $id = Supplier::latest('id')->value('id');
        $response = $this->putJson('/api/suppliers/' . $id, [
            'id' => $id,
            'name' => 'New test name',
            'phone' => '+998945784219',
            'contact_name' => 'New test contact',
            'website' => 'http://newtest.com',
            'description' => 'New test description',
            'created_by' => $id
        ]);

        $response->assertStatus(200);
    }

    public function test_supplier_delete(): void
    {
        $id = Supplier::latest()->value('id');
        $response = $this->deleteJson('/api/suppliers/' . $id);

        $response->assertStatus(200);
    }
}
