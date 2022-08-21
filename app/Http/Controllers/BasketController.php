<?php

namespace App\Http\Controllers;

use App\Exceptions\QuantityExceededException;
use App\Models\Product;
use App\Support\Basket\Basket;
use Illuminate\Http\Request;

class BasketController extends Controller
{
    private $basket;

    public function __construct(Basket $basket)
    {
        $this->basket = $basket ;
    }


    public function add(Product $product)
    {
        try {
            $this->basket->add($product,1);

            return back()->with('success-to-added',__('payment.added to basket'));
        } catch (QuantityExceededException $th) {
            return back()->with('error',__('payment.quantity exeeded'));
        }
    }

    public function index()
    {
        $items = $this->basket->all();
        return view('basket',compact('items'));
    }

    public function update(Request $request,Product $product)
    {
        $this->basket->update($product,$request->quantity);

        return back();
    }
}
