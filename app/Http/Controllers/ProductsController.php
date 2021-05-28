<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
    public function index()
    {
        return Product::with('attributes')->get(); //->paginate(5) (if many products)
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'attributes' => ['nullable', 'array'],
            'attributes.*.key' => ['required', 'string'],
            'attributes.*.value' => ['required', 'string']
        ]);
        if ($validator->fails()) {
            return [
                'status' => 'Error',
                'message' => $validator->messages()->first()
            ];
        }
        $product = Product::create([
            'name' => $request->input('name'),
            'description' => $request->input('description')
        ]);
        $product->save();
        if ($request->input('attributes')) {
            foreach ($request->input('attributes') as $attribute) {
                Attribute::create([
                    'product_id' => $product->id,
                    'key' => $attribute['key'],
                    'value' => $attribute['value']
                ]);
            }
        }
        return $product->load('attributes');
    }

    public function show(Product $product)
    {
        return $product->load('attributes');
    }

    public function update(Product $product, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'attributes' => ['nullable', 'array'],
            'attributes.*.key' => ['required', 'string'],
            'attributes.*.value' => ['required', 'string']
        ]);
        if ($validator->fails()) {
            return [
                'status' => 'Error',
                'message' => $validator->messages()->first()
            ];
        }
        $product->update([
            'name' => $request->input('name'),
            'description' => $request->input('description')
        ]);
        if ($request->input('attributes')) {
            foreach ($request->input('attributes') as $attribute) {
                Attribute::updateOrCreate(
                    [
                        'product_id' => $product->id,
                        'key' => $attribute['key']
                    ],
                    [
                        'value' => $attribute['value']
                    ]
                );
            }
        }
        return $product->load('attributes');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return Response::json([
            'status' => 'Success',
            'message' => 'Product with id: ' . $product->id . ' was deleted successfully',
        ]);
    }
}
