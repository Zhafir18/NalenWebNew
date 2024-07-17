<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\productModel; // Pastikan nama model disesuaikan dengan yang sebenarnya

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $productName = $request->get('productName');
        $products = productModel::when($productName, function($query, $productName) {
            return $query->where('product_name', 'like', '%' . $productName . '%');
        })->get();

        return view('home', compact('products'));
    }

    public function allProducts(Request $request)
    {
        $productName = $request->get('productName');
        $products = productModel::when($productName, function($query, $productName) {
            return $query->where('product_name', 'like', '%' . $productName . '%');
        })->get();

        return view('products.all', compact('products'));
    }


    public function productIndex(Request $request)
    {
        $productName = $request->get('productName');
        $products = productModel::when($productName, function($query, $productName) {
            return $query->where('product_name', 'like', '%' . $productName . '%');
        })->get();

        return view('products.index', compact('products'));
    }
    
    public function showForm($id = null)
    {
        $product = $id ? productModel::find($id) : null;
        return view('products.upsertForm', compact('product'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'productName' => 'required|string|max:255',
            'productDescription' => 'required|string|max:500',
            'productPrice' => 'required|numeric',
            'productImageFiles' => 'required|array',
            'productImageFiles.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:15000',
            'productLink' => 'nullable|string|max:255',
        ]);

        $imageNames = [];

        foreach ($request->file('productImageFiles') as $image) {
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $imageNames[] = $imageName;
        }

        productModel::create([
            'product_name' => $validatedData['productName'],
            'product_description' => $validatedData['productDescription'],
            'product_price' => $validatedData['productPrice'],
            'product_image' => json_encode($imageNames),
            'product_link' => $validatedData['productLink'],
        ]);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function edit($product_id)
    {
        $product = productModel::findOrFail($product_id);
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, $product_id)
    {
        $validatedData = $request->validate([
            'productName' => 'required|string|max:255',
            'productDescription' => 'required|string|max:255',
            'productPrice' => 'required|numeric',
            'productImageFile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'productLink' => 'nullable|string|max:255',
        ]);

        $product = productModel::findOrFail($product_id);

        $product->product_name = $validatedData['productName'];
        $product->product_description = $validatedData['productDescription'];
        $product->product_price = $validatedData['productPrice'];
        $product->product_link = $validatedData['productLink'];

        if ($request->hasFile('productImageFile')) {
            $imageName = time().'.'.$request->productImageFile->extension();
            $request->productImageFile->move(public_path('images'), $imageName);
            $product->product_image = $imageName;
        }

        $product->save();

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function deletes($id)
    {
        $product = productModel::findOrFail($id);

        // Hapus gambar produk dari direktori public
        $imagePath = public_path('images/' . $product->product_image);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }

    public function show($id)
    {
        $product = Product::find($id);

        if ($product) {
            return response()->json([
                'product_name' => $product->product_name,
                'product_price' => $product->product_price,
                'product_description' => $product->product_description,
                'product_image' => asset('images/' . $product->product_image),
            ]);
        } else {
            return response()->json([
                'error' => 'Product not found'
            ], 404);
        }
    }

}