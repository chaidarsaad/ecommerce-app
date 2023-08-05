<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProductGallery;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        $products = Product::orderBy('created_at', 'DESC')->get();
        return view('pages.admin.product.index', [
            'products' => $products,
            'categories' => $categories
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
    public function store(ProductRequest $request)
    {
        try {
            $data = $request->all();
            $data['slug'] = Str::slug($request->name);
            Product::create($data);
            return redirect()->route('product.index')->with('add-produk', "sukses");
        } catch (\Exception $e) {
            return back()->with('failed-add', "sukses");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        $galleries = ProductGallery::where('products_id', $id)->get();

        return view('pages.admin.product.gallery', [
            'product' => $product,
            'galleries' => $galleries
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = Product::with(['category'])->findOrFail($id);
        $categories = Category::all();

        return view('pages.admin.product.edit', [
            'item' => $item,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
    {
        try {
            $data = $request->all();

            $item = Product::findOrFail($id);

            $data['slug'] = Str::slug($request->name);

            $item->update($data);

            return redirect()->route('product.index')->with('update-produk', "sukses");
        } catch (\Exception $e) {
            return back()->with('failed-add', "sukses");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $item = Product::findorFail($id);
        $item->delete();

        return redirect()->route('product.index')->with('delete-produk', "sukses");
    }
}
