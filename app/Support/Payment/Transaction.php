<?php
namespace App\Support\Payment;

use App\Models\Order;
use App\Models\Payment;
use App\Support\Basket\Basket;
use App\Support\Payment\Gateways\GatewayInterface;
use App\Support\Payment\Gateways\Pasargad;
use App\Support\Payment\Gateways\Saman;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Transaction
{
    private $request;
    private $basket;

    public function __construct(Request $request,Basket $basket)
    {
        $this->request = $request ;
        $this->basket = $basket ;
    }

    public function checkout()
    {
        $order = $this->makeOrder();

        $payment = $this->makePayment($order);

        if($payment->isOnline()){
            return $this->gateWayFctory()->pay($order);
        }

        $this->basket->clear();

        return $order;
    }

    private function gateWayFctory()
    {
        $gateway=[
            'saman'=>Saman::class,
            'pasargad'=>Pasargad::class,
        ][$this->request->gateway];

        return resolve($gateway);
    }

    public function makePayment($order)
    {
        return Payment::create([
            'order_id'=>$order->id,
            'method'=>$this->request->method,
            'amount'=>$order->amount,
        ]);
    }

    private function makeOrder()
    {
        $order = Order::create([
            'user_id'=>auth()->user()->id,
            'code'=>bin2hex(Str::random(16)),
            'amount'=>$this->basket->subTotal()
        ]);

        $order->products()->attach($this->products());

        return $order;

    }

    private function products()
    {
        foreach ($this->basket->all() as $product) {
            $products[$product->id] = ['quantity' => $product->quantity];
        }

        return $products;
    }

    public function verify()
    {
        $result = $this->gateWayFctory()->verify($this->request);

        if($result['status'] == GatewayInterface::TRANSACTION_FAILED) return false ;

        $this->confirmPayment($result);

        $this->basket->clear();

        return true ;
    }

    public function confirmPayment($result)
    {
        return $result['order']->payment->confirm($result['refNum'] , $result['gateway']);
    }
}
