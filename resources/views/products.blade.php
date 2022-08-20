@extends('layouts.app')

@section('links')
<link rel="stylesheet" href="{{asset('css/style2.css')}}">
<link rel="stylesheet" href="{{asset('css/responsive.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

@section('content')

<div>
    @include('partials.alerts')
</div>

<div class="container">
    <div class="row">
        @foreach ($products as $product)
        <div class="col-xs-6 col-md-3 col-lg-2 col-xl-2" >
            <div class="box">
                <img class="responsive bor" src="{{asset('img/apple-watch.jpg')}}" alt="">
                <h4>{{$product->title}}</h4>
                <p>قیمت : <span>{{$product->price}}</span></p>
                <a href="{{route('basket.add',$product->id)}}"><h3>افزودن به سبد خرید</h3></a>
            </div>
        </div>
        @endforeach
    </div>
</div>


@endsection

