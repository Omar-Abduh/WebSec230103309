<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    use ValidatesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Products::select("products.*");

        $query->when(
            $request->keywords,
            fn($q) => $q->where("name", "like", "%$request->keywords%")
        );

        $query->when(
            $request->min_price,
            fn($q) => $q->where("price", ">=", $request->min_price)
        );

        $query->when($request->max_price, fn($q) =>
        $q->where("price", "<=", $request->max_price));

        $query->when(
            $request->order_by,
            fn($q) => $q->orderBy($request->order_by, $request->order_direction ?? "ASC")
        );

        $products = $query->get();

        return view('lec2.products.list', compact('products'));
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
    public function store(Request $request, Products $products = null)
    {
        $products = $products ?? new Products();
        $products->fill($request->all());
        $products->save();

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Products $products = null, Request $request)
    {
        $products = $products ?? new Products();
        return view('lec2.products.edit', compact('products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Products $products)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Products $products)
    {
        $products->delete();
        return redirect()->route('products.index');
    }
}
