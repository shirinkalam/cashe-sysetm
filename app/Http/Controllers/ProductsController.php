<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Support\Basket\Basket;
use App\Support\Storage\Contracts\StorageInterface;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return view('products',compact('products'));
    }
}
