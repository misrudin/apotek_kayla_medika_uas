<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = $request->input('query');
            $products = Product::where('name', 'LIKE', "%{$query}%")
                ->orWhere('category', 'LIKE', "%{$query}%")
                ->orWhere('price', 'LIKE', "%{$query}%")
                ->get();

            return response()->json($products);
        }

        $products = Product::all();
        return view("products.index", compact("products"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("products.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required",
            "category" => "required",
            "price" => "required|integer",
            "stock" => "required|integer",
            "photo" => "nullable|image|mimes:jpeg,png,jpg,gif|max:2048",
        ]);

        $data = $request->all();

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('photos', 'public');
            $data['photo'] = $path;
        }

        Product::create($data);

        return redirect()->route("products.index")->with("success", "Produk berhasil ditambahkan.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view("products.show", compact("product"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view("products.edit", compact("product"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            "name" => "required",
            "category" => "required",
            "price" => "required|integer",
            "stock" => "required|integer",
            "photo" => "nullable|image|mimes:jpeg,png,jpg,gif|max:2048",
        ]);

        $data = $request->all();

        if ($request->hasFile('photo')) {
            if ($product->photo && Storage::exists('public/' . $product->photo)) {
                Storage::delete('public/' . $product->photo);
            }

            $path = $request->file('photo')->store('photos', 'public');
            $data['photo'] = $path;
        }
        $product->update($data);
        return redirect()->route("products.index")->with("success", "Produk berhasil diupdate.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route("products.index")->with("success", "Produk berhasil dihapus.");
    }
}
