<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    public function test_product_get_list()
    {
        $user = User::first();
        $this->actingAs($user, 'api');
        $response = $this->get('/api/products');

        $response->assertStatus(200)->assertJsonStructure([
            'data' => [
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'description',
                        'category_id',
                        'supplier_id',
                        'price',
                        'file_url',
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
    public function test_product_create(): void
    {
        $user = User::first();
        $this->actingAs($user, 'api');

        $response = $this->postJson('/api/products', [
            'name' => 'Новый товар',
            'description' => 'Описание нового товара',
            'category_id' => Category::query()->inRandomOrder()->first()->id,
            'supplier_id' => Supplier::query()->inRandomOrder()->first()->id,
            'price' => 10000.11,
        ]);
        $response->assertStatus(200);
        $this->assertNotNull(Product::latest()->first());

        $response = $this->postJson('/api/products', [
            'name' => 142537896,
            'description' => 'Описание нового товара',
            'category_id' => Category::query()->inRandomOrder()->first()->id,
            'supplier_id' => 13231,
            'price' => 100000,
        ]);
        $response->assertStatus(422);
    }

    public function test_product_update(): void
    {
        $user = User::first();
        $this->actingAs($user, 'api');

        $id = Product::latest('created_at')->value('id');
        $response = $this->putJson('/api/products/' . $id, [
            'name' => 'Обновлённый товар',
            'description' => 'Описание обновлённого товара',
            'category_id' => Category::query()->inRandomOrder()->first()->id,
            'supplier_id' => Supplier::query()->inRandomOrder()->first()->id,
            'price' => 200000.01,
        ]);

        $response->assertStatus(200);
    }

    public function test_product_delete(): void
    {
        $user = User::first();
        $this->actingAs($user, 'api');
        $id = Product::latest('created_at')->value('id');
        $response = $this->deleteJson('/api/products/' . $id);

        $response->assertStatus(200);
    }
}
