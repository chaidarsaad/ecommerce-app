<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $wishlist = Wishlist::with(['product.galleries', 'user'])->where('users_id', Auth::user()->id)->get();
        // $addcart = Product::with(['galleries'])->where('slug')->firstOrFail();

        return view('pages.wishlist', [
            'wishlist' => $wishlist
            // 'addcart' => $addcart
        ]);
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
    public function store(Request $request, $id)
    {
        try {
            $data = [
                'products_id' => $id,
                'users_id' => Auth::user()->id
            ];

            Cart::create($data);

            return redirect()->route('cart')->with('suksesadd', "Produk berhasil ditambahkan ke keranjangmu");
        } catch (Exception $e) {
            return back()->with('status', "Produk ini sudah ada di keranjangmu");
        }
    }

    public function addtocart(Request $request, $id)
    {
        try {
            $data = [
                'products_id' => $id,
                'users_id' => Auth::user()->id
            ];

            Cart::create($data);

            return redirect()->route('cart')->with('suksesadd', "Produk berhasil ditambahkan ke keranjangmu");
        } catch (Exception $e) {
            return back()->with('status', "Produk ini sudah ada di keranjangmu");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        $cart = Wishlist::findOrFail($id);

        $cart->delete();

        return redirect()->route('wishlist')->with('suksesdel', "Produk Berhasil dihapus");
    }
}
