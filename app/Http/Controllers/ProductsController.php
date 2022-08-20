<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Support\Storage\Contracts\StorageInterface;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        $sessionStorage = resolve(StorageInterface::class);

        // $sessionStorage->set('product',1);
        // $sessionStorage->set('item',1);
        // $sessionStorage->set('test',1);
        // $sessionStorage->unset('item');

        // dd($sessionStorage->count());

        // dd($sessionStorage->all());

        $products = Product::all();

        return view('products',compact('products'));
    }
}
