@extends('user.layouts.style')
@section('content')
<form action="{{ route('placeOrder') }}" method="POST">
    @csrf
<div class="row mt-5 d-flex justify-content-center">
   Order Page
    <div class="col-4 ">
        <img src="{{ asset('uploads/' . $pizzaDetails->image) }}" class="img-thumbnail" width="300px">            <br>
       
    </div>
   
    <div class="col-6">
        @if (Session::has('totalTime'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
         Order Success.Please Wait    {{ Session::get('totalTime') }} MINS
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          @endif
        <span class="fs-5">Name : &nbsp;</span>
         <span><b>{{ $pizzaDetails->pizza_name }}</b></span>
    <hr>
         <span class="fs-5">Total Price : &nbsp;</span>
         <span><b>{{ $pizzaDetails->price }}</b> MMK</span>
      <hr>
      
      <span class="fs-5">Waiting Time : &nbsp;</span>
      <span><b>{{ $pizzaDetails->waiting_time }}</b> MINS</span>
      <hr>
    
      <br>
      Pizza Count : &nbsp;<input type="number" name="pizzaCount" class="form-contorl"><br><br>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="paymentType" id="flexRadioDefault1" value="1">
        <label class="form-check-label" for="flexRadioDefault1">
        Credit Card 
        </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="paymentType" id="flexRadioDefault2"  value="2">
        <label class="form-check-label" for="flexRadioDefault2">
          Cash On Delivery 
        </label><br><br>
       <input type="submit" value="Place Order" class="btn bg-dark text-white">
       
      </div>
        </div>
   </form>
   {{-- <a href="{{ route('pizzaDetails') }}">
    <button class="btn bg-dark text-white" style="margin-top: 20px;">
        <i class="fas fa-backspace"></i> Back
    </button>
</a> --}}
</div>

    
@endsection