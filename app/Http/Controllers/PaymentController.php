<?php

namespace App\Http\Controllers;

use App\Support\Payment\Transaction;
use Illuminate\Http\Request;

class PaymentController extends Controller
{

    private $transaction;

    public function __construct(Transaction $transaction)
    {
       $this->transaction = $transaction;
    }

    public function verify()
    {
         return $this->transaction->verify()
        ? $this->sendSuccesResponse()
        : $this->sendErrorResponse();

    }

    public function sendErrorResponse()
    {
        return redirect()->route('home')->with('error','مشکلی در هنگام ثبت سفارش به وجود آمده است');
    }

    public function sendSuccesResponse()
    {
        return redirect()->route('home')->with('seccess','سفارش شما با موفقیت ارسال شد');
    }
}
