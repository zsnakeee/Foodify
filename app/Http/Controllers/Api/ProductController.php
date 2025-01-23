<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Product::query();
        $filters = [
            'active' => 'is_active',
            'new' => 'is_new',
            'featured' => 'is_featured',
            'best' => 'is_best',
            'hot' => 'is_hot',
            'in_stock' => ['quantity', '>', 0],
        ];

        foreach ($filters as $key => $value) {
            if (request()->boolean($key)) {
                is_array($value) ?
                    $query->where(...$value) :
                    $query->where($value, true);
            }
        }

        // Filter by category
        request()->has('category') && $query->whereHas('category', function ($query) {
            $query->whereJsonContains('slug', request('category'))
                ->orWhereJsonContains('name', 'like', '%'.request('category').'%');
        });

        // Filter by brand
        request()->has('brand') && $query->whereHas('brand', function ($query) {
            $query->whereJsonContains('slug', request('brand'))
                ->orWhereJsonContains('name', 'like', '%'.request('brand').'%');
        });

        return ProductResource::collection($query->paginate());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return new ProductResource(Product::findOrFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
