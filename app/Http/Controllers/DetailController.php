<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DetailController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request, $id)
    {
        $product = Product::with(['galleries'])->where('slug', $id)->firstOrFail();

        return view('pages.detail', [
            'product' => $product
        ]);
    }

    // add to cart
    public function add(Request $request, $id)
    {
        try {
            $data = [
                'products_id' => $id,
                'users_id' => Auth::user()->id,
                'quantity' => 1
            ];

            Cart::create($data);

            return redirect()->route('cart')->with('suksesadd', "Produk berhasil ditambahkan ke keranjangmu");
        } catch (Exception $e) {
            return back()->with('status', "Produk ini sudah ada di keranjangmu");
        }
    }

    // add to favorit
    public function addfav(Request $request, $id)
    {
        try {
            $data = [
                'products_id' => $id,
                'users_id' => Auth::user()->id
            ];

            Wishlist::create($data);

            return redirect()->route('wishlist')->with('suksesadd', "Produk berhasil ditambahkan ke keranjangmu");
        } catch (Exception $e) {
            return back()->with('statuswishlist', "Produk ini sudah ada di keranjangmu");
        }
    }
}
