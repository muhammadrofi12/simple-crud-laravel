<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() {
        $products = Product::with('category')->get();

        return response()->json(data: [
            'status' => 200,
            'message' => 'Data berhasil diambil',
            'data' => $products
        ]);
    }
}
