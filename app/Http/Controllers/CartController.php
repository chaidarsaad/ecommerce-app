<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $carts = Cart::with(['product.galleries', 'user'])->where('users_id', Auth::user()->id)->get();

        return view('pages.cart', [
            'carts' => $carts,
        ]);
    }

    public function delete(Request $request, $id)
    {
        $cart = Cart::findOrFail($id);

        $cart->delete();

        return redirect()->route('cart')->with('suksesdel', "Produk Berhasil dihapus");
    }

    public function update(Request $request, string $id)
    {
        try {
            $cart = Cart::findOrFail($id);
            $cart->quantity = $request->input('quantity');
            $cart->update();
            return redirect()->route('cart');
        } catch (\Exception $e) {
            $cart = Cart::findOrFail($id);

            $cart->delete();

            return redirect()->route('cart');
        }
    }

    public function success()
    {
        return view('pages.success');
    }
}
