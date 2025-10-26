<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    public function test_category_get_list()
    {
        $user = User::first();
        $this->actingAs($user, 'api');
        $response = $this->get('/api/categories');

        $response->assertStatus(200)->assertJsonStructure([
            'data' => [
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'parent_id',
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
    public function test_category_create(): void
    {
        $user = User::first();
        $this->actingAs($user, 'api');

        $response = $this->postJson('/api/categories', [
            'name' => 'Test name',
            'parent_id' => '',
        ]);
        $response->assertStatus(200);
        $this->assertNotNull(Category::latest()->first());

        $response = $this->postJson('/api/categories', [
            'name' => 6546,
            'parent_id' => '+998945784457',
        ]);
        $response->assertStatus(422);
    }

    public function test_category_update(): void
    {
        $user = User::first();
        $this->actingAs($user, 'api');

        $id = Category::latest('created_at')->value('id');
        $response = $this->putJson('/api/categories/' . $id, [
            'id' => $id,
            'name' => 'New test name',
        ]);

        $response->assertStatus(200);
    }

    public function test_category_delete(): void
    {
        $user = User::first();
        $this->actingAs($user, 'api');
        $id = Category::latest('created_at')->value('id');
        $response = $this->deleteJson('/api/categories/' . $id);

        $response->assertStatus(200);
    }
}
