@extends('user.layouts.style')
@section('content')
<div class="row mt-5 d-flex justify-content-center">
   
    <div class="col-4 ">
        <img src="{{ asset('uploads/' . $pizzaDetails->image) }}" class="img-thumbnail" width="300px">            <br>
        <button class="btn btn-primary float-end mt-2 col-12"><i class="fas fa-shopping-cart"></i> Buy</button>
        <a href="{{ route('user') }}">
            <button class="btn bg-dark text-white" style="margin-top: 20px;">
                <i class="fas fa-backspace"></i> Back
            </button>
        </a>
    </div>
    <div class="col-6">
    <span class="fs-5">Name : &nbsp;</span>
     <span><b>{{ $pizzaDetails->pizza_name }}</b></span>
<hr>
     <span class="fs-5">Price : &nbsp;</span>
     <span><b>{{ $pizzaDetails->price }}</b> MMK</span>
  <hr>
  <span class="fs-5">Discount : &nbsp;</span>
  <span><b>{{ $pizzaDetails->discount_price }}</b> MMK</span>
  <hr>
  <span class="fs-5">Waiting Time : &nbsp;</span>
  <span><b>{{ $pizzaDetails->waiting_time }}</b> MINS</span>
  <hr>
  <span class="fs-5">Description : &nbsp;</span>
  <span><b>{{ $pizzaDetails->description }}</b></span>
  <hr>
  <br>
  <span class="fs-3">Total : &nbsp;</span>
  <span class="fs-4"><b>{{ $pizzaDetails->price - $pizzaDetails->discount_price }} MMK</b></span>
    </div>
</div>

    
@endsection