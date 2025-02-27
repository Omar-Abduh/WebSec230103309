<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = (object)[
            (object)['id'=>1, 'code'=>'TV01', 'name'=>'LG TV 50"', 
            'model' =>'LG8768787', 'photo'=>'lg.jpg', 
            'description'=>'lorem ipsum..'],
            (object)['id'=>2, 'code'=>'RF01', 'name'=>'Toshiba Refrigerator 14"',
            'model'=>'TS76634', 'photo'=>'toshiba-refrigerator.jpg',    
            'description'=>'lorem ipsum..'],
     ];
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
    public function store(Request $request)
    {
        //
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
    public function edit(Products $products)
    {
        //
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
        //
    }
}
