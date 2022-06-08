@extends('admin.layout.app')


@section('content')
    <div class="content-wrapper">

    <section class="content">
   

        <div class="container-fluid">
          @if (Session::has('createPizza'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
              {{ Session::get('createPizza') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
          <div class="row mt-4">
            <div class="col-8 offset-3 mt-5">

              <div class="col-md-9">
                <a href="{{ route('pizzaGet') }}" class="text-decoration-none text-dark "> <i class="fas fa-arrow-left"></i>Back</a>

                <div class="card">
                  <div class="card-header p-2">
                    <legend class="text-center">Pizza Information</legend>
                  </div>
                  <div class="card-body">
                    <div class="tab-content">
                      <div class="active tab-pane" id="activity">
                     <div class="text-center">
                        <img src="{{ asset('/uploads/' . $pizzaInfo->image) }}" class="img-thumbnail" width="100px" height="100px" class="rounded-circle" style="border-radius: 30px">
                    </div>
                        <div class="text-center">
                            <div class="">
                                <label>Pizza Name:</label> <label>{{ $pizzaInfo->pizza_name }}</label>
                            </div>
                            <div class="">
                                <label>Description:</label> <label>{{ $pizzaInfo->description }}</label>
                            </div>
                            <div class="">
                                <label>Price:</label> <label>{{ $pizzaInfo->price }}</label>
                            </div>
                            <div class="">
                                <label>Publish Status:</label>
                                @if ($pizzaInfo->publish==0)
                                    Publish
                                @else
                                    Unpublish
                                @endif
                            </div>
                            <div class="">
                                <label>Category ID:</label> <label>{{ $pizzaInfo->category_id }}</label>
                            </div>
                            <div class="">
                                <label>Discount:</label> <label> {{ $pizzaInfo->discount_price }}MMK</label>
                            </div>
                            <div class="">
                                <label>Buy 1 Get 1 Free:</label>
                                @if ($pizzaInfo->buy_one_get_one_status==1)
                                   No
                                @else
                                   Yes
                                @endif
                            </div>
                            <div class="">
                                <label>Waiting Time:</label> <label>{{ $pizzaInfo->waiting_time }} MINS</label>
                            </div>
                        </div>
                      </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
  
  </div>
@endsection
