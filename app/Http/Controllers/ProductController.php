<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return Product::all();
    }

    public function show($id)
    {
        return Product::findOrFail($id);
    }
    public function store(CreateProductRequest $request)
    {
        return Product::create($request->validated());
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        return $product->update($request->all());
    }
}
