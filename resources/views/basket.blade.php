@extends('layouts.app')

@section('links')
<link rel="stylesheet" href="{{asset('css/style2.css')}}">
<link rel="stylesheet" href="{{asset('css/responsive.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
<link rel="stylesheet" href="{{asset('css/users.css')}}">
@section('content')

@include('partials.alerts')

@if ($items->isEmpty())
    <p>@lang('basket.empty basket')</p>

@else
	<!-- Component Start -->
	<div class="grid lg:grid-cols-3 md:grid-cols-2 gap-8 w-full max-w-screen-lg">
		<div class="lg:col-span-2">
			<div>
                <table cellspacing="0" cellpadding="0" class="table">
                    <thead>
                       <tr id="table-top">
                        <th>
                            <h3>@lang('basket.product name')</h3>
                         </th>
                         <th>
                            <h3>@lang('basket.product price')</h3>
                         </th>
                         <th>
                            <h3>@lang('basket.quantity')</h3>
                         </th>
                       </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                        <tr>
                            <td>{{$item->title}}</td>
                            <td>{{number_format($item->price)}}</td>
                            <td>
                                <form action="{{route('basket.update',$item->id)}}" method="POST">
                                    @csrf
                                    <select name="quantity" id="">
                                        @for ($i = 0; $i <= $item->stock; $i++)
                                            <option {{$item->quantity == $i ? 'selected' : ''}} value="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </select>
                                    <button class="submit" type="submit">
                                        @lang('basket.update')
                                    </button>
                                </form>
                            </td>
                         </tr>
                        @endforeach
                    </tbody>
                 </table>
            </div>
				</div>
			</div>
		</div>
        @inject('basket','App\Support\Basket\Basket' )
		<div>
			<div class="bg-white rounded mt-4 shadow-lg py-6">
				<div class="px-8">
					<div class="flex items-end">
						<h1>@lang('basket.payment')</h1>
					</div>
				</div>
                <div class="px-8 mt-4">
					<div class="flex items-end justify-between">
						<span class="text-sm font-semibold">@lang('basket.total amount')</span>
						<span class="text-sm text-gray-500 mb-px">{{number_format($basket->subTotal())}}</span>
					</div>
				</div>
                <div class="px-8 mt-4">
					<div class="flex items-end justify-between">
						<span class="text-sm font-semibold">@lang('basket.transportation costs')</span>
						<span class="text-sm text-gray-500 mb-px">{{number_format(10000)}}</span>
					</div>
				</div>
                <div class="px-8 mt-4">
					<div class="flex items-end justify-between">
						<span class="text-sm font-semibold">@lang('basket.amount payble')</span>
						<span class="text-sm text-gray-500 mb-px">{{number_format($basket->subTotal()+ 10000)}}</span>
					</div>
				</div>
				<div class="px-8 mt-4 border-t pt-4">
				</div>
				<div class="flex flex-col px-8 mt-4 pt-4">
					<a href="{{route('basket.checkout.form')}}" class="flex items-center justify-center bg-blue-600 text-sm font-medium w-full h-10 rounded text-blue-50 hover:bg-blue-700">@lang('basket.continue the order')</a>
				</div>
			</div>
		</div>
	</div>
	<!-- Component End  -->

@endif
@endsection
