<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;

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
        if (!auth()->user()->hasPermissionTo('add_products') && !auth()->user()->hasPermissionTo('edit_products')) abort(401);

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
        if (!auth()->user()->hasPermissionTo('add_products') && !auth()->user()->hasPermissionTo('edit_products')) abort(401);

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

    /**
     * Add a product to the cart.
     */
    public function addToCart(Products $product)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            // If product already exists in cart, increase quantity
            $cart[$product->id]['quantity']++;
        } else {
            // Add new product to the cart
            $cart[$product->id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "photo" => $product->photo
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('products.index')->with('success', "{$product->name} added to cart.");
    }

    /**
     * View the cart.
     */
    public function viewCart()
    {
        $cart = session()->get('cart', []);
        return view('lec2.products.cart', compact('cart'));
    }

    /**
     * Update the cart.
     */
    public function updateCart(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            if ($request->action == 'increase') {
                $cart[$id]['quantity']++;
            } elseif ($request->action == 'decrease') {
                $cart[$id]['quantity']--;
                if ($cart[$id]['quantity'] <= 0) {
                    unset($cart[$id]);
                }
            }
        }

        session()->put('cart', $cart);

        return redirect()->route('products.viewCart')->with('success', 'Cart updated.');
    }

    /**
     * View bought products.
     */
    public function viewBoughtProducts()
    {
        $user = Auth::user();
        $boughtProducts = $user->boughtProducts; // Assuming a relationship is defined in the User model
        return view('lec2.products.bought_products', compact('boughtProducts'));
    }

    /**
     * Purchase products using account credit.
     */
    public function purchase(Request $request)
    {
        $cart = session()->get('cart', []);
        $total = array_reduce($cart, function ($carry, $item) {
            return $carry + ($item['price'] * $item['quantity']);
        }, 0);

        $user = Auth::user();

        if ($user->credit >= $total) {
            // Deduct the total from user's credit
            $user->credit -= $total;
            $user->save();

            // Add products to bought products list
            foreach ($cart as $id => $details) {
                // Logic to add products to bought products list
                $user->boughtProducts()->attach($id, ['quantity' => $details['quantity']]);
            }

            // Clear the cart
            session()->forget('cart');

            return redirect()->route('products.index')->with('success', 'Purchase successful.');
        } else {
            return redirect()->route('products.viewCart')->with('error', 'Insufficient credit.');
        }
    }
}
