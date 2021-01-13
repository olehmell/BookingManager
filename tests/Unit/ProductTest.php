<?php

namespace Tests\Unit;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_new_product_can_be_created()
    {
        $product = Product::factory()->make()->toArray();

        $this->post(route('products.store'), $product)->assertStatus(201);

        $this->assertCount(1, Product::all());
    }

    public function test_a_product_can_be_updated()
    {
        $product = Product::factory()->create();

        $this->patch(route('products.update', $product->id), ['name' => 'updated'])->assertStatus(200);

        $this->assertEquals('updated', Product::find($product->id)->name);
    }

    public function test_a_product_cannot_be_created_without_a_type_id()
    {
        $product = Product::factory()->make(['type_id' => null])->toArray();

        $this->post(route('products.store'), $product)->assertStatus(302);

        $this->assertDatabaseCount('products', 0);
    }

    public function test_a_product_can_be_shown()
    {
        $product = Product::factory()->create();

        $this->get(route('products.show', $product->id))->assertStatus(200)->assertSee('name', $product->name);
    }
}
