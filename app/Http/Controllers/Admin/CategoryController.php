<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderBy('created_at', 'DESC')->get();
        return view('pages.admin.category.index', [
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        try {
            $data = $request->all();

            $data['slug'] = Str::slug($request->name);
            $data['photo'] = $request->file('photo')->store('assets/category', 'public');

            Category::create($data);

            return redirect()->route('category.index')->with('add-category', "sukses");
        } catch (\Exception $e) {
            return back()->with('failed-add', "sukses");
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
        $item = Category::findOrFail($id);

        return view('pages.admin.category.edit', [
            'item' => $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        try {
            $data = $request->all();

            $data['slug'] = Str::slug($request->name);
            // $data['photo'] = $request->file('photo')->store('assets/category', 'public');
            if ($request->hasFile('photo')) {
                $data['photo'] = $request->file('photo')->store('assets/category', 'public');
            }


            $item = Category::findOrFail($id);

            $item->update($data);

            return redirect()->route('category.index')->with('update-category', "sukses");
        } catch (\Exception $e) {
            return back()->with('failed-add', "sukses");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Category::findOrFail($id);
        $item->delete();
        return redirect()->route('category.index')->with('delete-category', "sukses");
    }
}
