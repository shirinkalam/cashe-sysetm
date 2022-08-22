<?php

namespace App\Http\Controllers;

use App\Exceptions\QuantityExceededException;
use App\Models\Product;
use App\Support\Basket\Basket;
use App\Support\Payment\Transaction;
use Illuminate\Http\Request;

class BasketController extends Controller
{
    private $basket;
    private $transaction;

    public function __construct(Basket $basket,Transaction $transaction)
    {
        $this->middleware('auth')->only(['checkoutForm']);
        $this->basket = $basket ;
        $this->transaction = $transaction ;
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

    public function checkoutForm()
    {
        $items = $this->basket;

        return view('checkout',compact('items'));
    }

    public function checkout(Request $request)
    {
        $this->validateForm($request);

        $order = $this->transaction->checkout();

        return redirect()->route('home')->with('success');
    }

    protected function validateForm($request)
    {
        $request->validate([
            'method'=>['required'],
            'gateway'=>['required_if:method,online'],
        ]);
    }
}
