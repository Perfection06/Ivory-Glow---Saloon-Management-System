<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $categories = [
            'Stylist', 'Hairdresser', 'Barber', 'Colorist', 'Beautician',
            'Skin Care Specialist', 'Massage Therapist', 'Nail Technician'
        ];
        return view('admin.AddProduct', compact('products', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|array|min:1',
            'category.*' => 'in:Stylist,Hairdresser,Barber,Colorist,Beautician,Skin Care Specialist,Massage Therapist,Nail Technician',
            'quantity' => 'required|integer|min:0',
            'unit_price' => 'required|numeric|min:0',
            'unit' => 'required|string|max:50',
        ]);

        $productData = $request->all();
        $productData['category'] = implode(',', $request->category);

        Product::create($productData);

        return redirect()->route('product.index')->with('success', 'Product added successfully!');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $products = Product::all();
        $categories = [
            'Stylist', 'Hairdresser', 'Barber', 'Colorist', 'Beautician',
            'Skin Care Specialist', 'Massage Therapist', 'Nail Technician'
        ];
        return view('admin.AddProduct', compact('product', 'products', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|array|min:1',
            'category.*' => 'in:Stylist,Hairdresser,Barber,Colorist,Beautician,Skin Care Specialist,Massage Therapist,Nail Technician,Receptionist,Cleaner',
            'quantity' => 'required|integer|min:0',
            'unit_price' => 'required|numeric|min:0',
            'unit' => 'required|string|max:50',
        ]);

        $productData = $request->all();
        $productData['category'] = implode(',', $request->category);

        $product->update($productData);

        return redirect()->route('product.index')->with('success', 'Product updated successfully!');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('product.index')->with('success', 'Product deleted successfully!');
    }
}