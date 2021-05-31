<?php
declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductsControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testUpdate()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $product = Product::factory()->create();
        $response = $this->putJson('api/products/' . $product->id, [
            'name' => 'Milk',
            'description' => 'Super healthy!',
            'attributes' => [
                ['key' => 'Fat content', 'value' => '2%'],
                ['key' => 'Color', 'value' => 'white']
            ]
        ]);
        $response->assertStatus(200);
        $response->assertJson([
            'name' => 'Milk',
            'description' => 'Super healthy!',
            'attributes' => [
                ['key' => 'Fat content', 'value' => '2%'],
                ['key' => 'Color', 'value' => 'white']
            ]
        ]);
    }

    public function testIndex()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $product1 = Product::factory()->create();
        $product2 = Product::factory()->create();
        $response = $this->getJson('api/products');
        $response->assertStatus(200);
        $response->assertJson([
            [
                'id' => $product1->id,
                'name' => $product1->name,
                'description' => $product1->description
            ],
            [
                'id' => $product2->id,
                'name' => $product2->name,
                'description' => $product2->description
            ]
        ]);
    }

    public function testDestroy()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $product = Product::factory()->create();
        $response = $this->deleteJson('api/products/' . $product->id);
        $response->assertStatus(200);
        $response->assertJson([
            'status' => 'Success',
            'message' => ['Product with id: ' . $product->id . ' was deleted successfully']
        ]);
    }

    public function testShow()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $product = Product::factory()->create();
        $response = $this->getJson('api/products/' . $product->id);
        $response->assertStatus(200);
        $response->assertJson([
            'name' => $product->name,
            'description' => $product->description
        ]);
    }

    public function testStore()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->postJson('api/products', [
            'name' => 'Milk',
            'description' => 'Super healthy!',
            'attributes' => [
                ['key' => 'Fat content', 'value' => '2%'],
                ['key' => 'Color', 'value' => 'white']
            ]
        ]);
        $response->assertStatus(201);
    }
}
