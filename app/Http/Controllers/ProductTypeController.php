<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductTypeRequest;
use App\Models\ProductType;
use Illuminate\Support\Facades\Request;

class ProductTypeController extends Controller
{
    public function index()
    {
        return ProductType::all();
    }

    public function show($id)
    {
        return ProductType::findOrFail($id);
    }

    public function store(CreateProductTypeRequest $request)
    {
        return ProductType::create($request->validated());
    }

    public function update(CreateProductTypeRequest $request, $id)
    {
        $type = ProductType::findOrFail($id);

        return $type->update($request->validated());
    }

    public function destroy($id)
    {
        $type = ProductType::findOrFail($id);

        return $type->delete();
    }
}
