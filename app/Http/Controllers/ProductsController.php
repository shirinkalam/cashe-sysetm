<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Support\Storage\Contracts\StorageInterface;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        dump(session()->all());

        $products = Product::all();

        return view('products',compact('products'));
    }
}
