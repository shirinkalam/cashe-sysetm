<?php

namespace App\Http\Controllers;

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
        $this->basket->add($product,1);

        return back()->with('success-to-added',__('payment.added to basket'));
    }
}
