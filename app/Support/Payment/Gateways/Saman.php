<?php

namespace App\Support\Payment\Gateways;

use App\Models\Order;
use Illuminate\Http\Request;

class Saman implements GatewayInterface
{

    private $merchantID;
    private $callback;

    public function __construct()
    {
        $this->merchentID = '452585658';
        $this->callback   = route('payment.verify',$this->getName());
    }

    public function pay(Order $order)
    {
        $this->redirectToBank($order);
    }

    public function verify(Request $request)
    {
        if(!$request->has('State') || $request->input('State') !== 'OK'){
            return $this->transactionFailed();
        }

        $soapClient = new \SoapClient('https://aquirer.samanpay.com/payments,refrencepayment.asmx?WSDL');

        $response =$soapClient->VerifyTransaction($request->input('RefNum') , $this->merchantID);

        $order = $this->getOrder($request->input('ResNum'));

        return $response == ($order->amount + 1000)
            ? $this->transactionSuccess($order , $request->input('RefNum'))
            : $this->transactionFailed();
    }

    public function getOrder($resNum)
    {
        return Order::where('code',$resNum)->firstOrFail();
    }

    private function transactionFailed()
    {
        return[
            'status'=>self::TRANSACTION_FAILED,
        ];
    }

    private function transactionSuccess($order,$refNum)
    {
        return[
            'status'=>self::TRANSACTION_SUCCESS,
            'order' =>$order,
            'refNum' =>$refNum,
            'gateway' =>$this->getName()
        ];
    }

    public function getName(): string
    {
        return 'saman';
    }

    private function redirectToBank($order)
    {
        $amount = $order->amount + 10000;

        echo "<form id='samanpeyment' action='https://sep.shaparak.ir/Payment.aspx' method='POST'>
        <input type='hidden' name='Amount' value='{$amount}'/>
        <input type='hidden' name='ResNum' value='{$order->code}'/>
        <input type='hidden' name='RedirectURL' value='{$this->callback}'/>
        <input type='hidden' name='MID' value='{$this->merchantID}'/>
        </form><script>document.getElementById['samanpeyment'].submit()</script>";

    }
}
