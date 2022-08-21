@extends('layouts.app')

@section('links')
<link rel="stylesheet" href="{{asset('css/checkout.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

@section('content')
<div class='container'>
    <div class='window'>
      <div class='order-info'>
        <div class='order-info-content'>
            <h2>لطفا روش پرداخت را انتخاب نمایید</h2>
          <div class='line'></div>

          <form action="{{route('basket.checkout')}}" method="post" >
            @csrf
            <ul>
                <li>
                    <div>
                        <input type="radio" name="method" value="online">
                        <label for="online">
                            پرداخت آنلاین
                        </label>

                        <select name="gateway" id="">
                            <option value="saman">سامان</option>
                            <option value="pasargad">پاسارگاد</option>
                        </select>
                    </div>
                </li>

                <li>
                    <div>
                        <input type="radio" name="method" value="ofline">
                        <label for="online">
                            پرداخت نقدی
                        </label>

                    </div>
                </li>

                <li>
                    <div>
                        <input type="radio" name="method" value="cart-to-cart">
                        <label for="online">
                            پرداخت کارت به کارت
                        </label>

                    </div>
                </li>
            </ul><br>

            <br><button type="submit" class='pay-btn'>پرداخت</button>
        </form>

          <div class='total'>
            <span style='float:left;'>
              <div class='thin dense'>هزینه ارسال</div>
              جمع کل
            </span>
            <span class='thin dense'>{{number_format(10000)}}</span><br>
            <span style='float:right; text-align:right;'>{{number_format($items->subTotal()+ 10000)}}</span>
          </div>
  </div>
  </div>
          <div class='credit-info'>
            <div class='credit-info-content'>

                <h1>صفحه ی پرداخت</h1>
              گیرنده
              <input class='input-field' readonly value="{{Auth::user()->name}}" >
              آدرس
              <input class='input-field' readonly value="{{Auth::user()->adress}}" >
               شماره تلفن
              <input class='input-field' readonly value="{{Auth::user()->phone_number}}">


            </div>

          </div>
        </div>
      </div>

  iv>


@endsection

