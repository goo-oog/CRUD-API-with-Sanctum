<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductsResource;
use App\Models\Attribute;
use App\Models\Product;
use Illuminate\Support\Facades\Response;

class ProductsController extends Controller
{
    public function index()
    {
        return ProductsResource::collection(Product::all());
    }

    public function store(ProductRequest $request)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            return Response::json([
                'status' => 'Error',
                'message' => $request->validator->errors()->all()
            ], 400);
        }
        $product = Product::create([
            'name' => $request->input('name'),
            'description' => $request->input('description')
        ]);
        if ($request->input('attributes')) {
            foreach ($request->input('attributes') as $attribute) {
                Attribute::create([
                    'product_id' => $product->id,
                    'key' => $attribute['key'],
                    'value' => $attribute['value']
                ]);
            }
        }
        return new ProductResource($product);
    }

    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    public function update(Product $product, ProductRequest $request)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            return Response::json([
                'status' => 'Error',
                'message' => $request->validator->errors()->all()
            ], 400);
        }
        $product->update([
            'name' => $request->input('name'),
            'description' => $request->input('description')
        ]);
        if ($request->input('attributes')) {
            $product->attributes()->delete();
            foreach ($request->input('attributes') as $attribute) {
                Attribute::create(
                    [
                        'product_id' => $product->id,
                        'key' => $attribute['key'],
                        'value' => $attribute['value']
                    ]
                );
            }
        }
        return new ProductResource($product);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return Response::json([
            'status' => 'Success',
            'message' => ['Product with id: ' . $product->id . ' was deleted successfully']
        ]);
    }
}
