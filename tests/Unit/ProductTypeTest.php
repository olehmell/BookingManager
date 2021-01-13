<?php

namespace Tests\Unit;


use App\Models\ProductType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTypeTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_new_product_type_can_be_created()
    {
        $data = ProductType::factory()->make()->toArray();

        $this->post(route('types.store', $data))->assertStatus(201);

        $this->assertCount(1, ProductType::all());
    }

    public function test_a_new_product_type_cannot_have_a_duplicate_name()
    {
        $data = ProductType::factory()->make()->toArray();

        $this->post(route('types.store', $data))->assertStatus(201);

        $this->post(route('types.store', $data))->assertStatus(302);

        $this->assertCount(1, ProductType::all());
    }

    public function test_a_product_type_can_be_updated()
    {
        $data = ProductType::factory()->create();

        $this->patch(route('types.update', $data->id), ['name' => 'updated'])->assertStatus(200);

        $this->assertEquals('updated', ProductType::find($data->id)->name);
    }

    public function test_a_product_type_can_be_shown()
    {
        $data = ProductType::factory()->create();

        $this->get(route('types.show', $data->id))->assertSee($data->name);
    }

    public function test_all_product_types_can_be_listed()
    {
        ProductType::factory()->count(5)->create();

        $this->get(route('types.index'))->assertJsonCount(5);
    }

    public function test_a_product_type_can_be_delete()
    {
       $type = ProductType::factory()->create();

        $this->delete(route('types.destroy', $type->id))->assertStatus(200);

        $this->assertEmpty(ProductType::all());
    }
}
