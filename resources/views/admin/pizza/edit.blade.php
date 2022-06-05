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
                    <legend class="text-center">Add Pizza</legend>
                  </div>
                  <div class="card-body">
                    <div class="tab-content">
                      <div class="active tab-pane" id="activity">
                     <div class="text-center">
                        <img src="{{ asset('/uploads/' . $pizzaEdit->pizza_image) }}" class="img-thumbnail" width="100px" height="100px" class="rounded-circle" style="border-radius: 30px">
                    </div>
                        <form action="" method="POST" enctype="multipart/form-data">
                          <div class="">
                            <div class="">
                              <input type="file" name="image"  class="form-control">
                            </div>
                              <div class="">
                                  <label >Pizza Name:</label>
                                  <input type="text" name="name" value="{{ $pizzaEdit->pizza_name }}" class="form-control">
                              </div>
                              <div class="">
                                  <label>Description:</label> 
                                  <input type="text" name="description" value="{{ $pizzaEdit->description }}" class="form-control">
                              </div>
                              <div class="">
                                  <label>Price:</label> 
                                  <input type="text" name="price" value="{{ $pizzaEdit->price }}" class="form-control">
                              </div><br>
                              <div class="">
                                  <label>Publish Status:</label>
                                  {{-- @if ($pizzaEdit->publish==0)
                                      Publish
                                  @else
                                      Unpublish
                                  @endif --}}
                                  <select name="publish" id="">
                                    @if ($pizzaEdit->publish==0)
                                    <option value="0" selected>Publish</option>
                                    <option value="1">Unpublish</option>
                                    @else
                                    <option value="0" >Publish</option>
                                    <option value="1" selected>Unpublish</option>
                                    @endif
                                  </select>
                              </div>
                              <div class="">
                                  <label>Category ID:</label> <label></label>
                              </div><br>
                              <div class="">
                                  <label>Discount:</label>
                                  <input type="text" name="discount" value="{{ $pizzaEdit->discount_price}} MMK" class="form-control">
                              </div>
                              <div class="">
                                  <label>Buy 1 Get 1 Free:</label>
                                  @if ($pizzaEdit->buy_one_get_one_status==1)
                                     No
                                  @else
                                     Yes
                                  @endif
                              </div>
                              <div class="">
                                  <label>Waiting Time:</label>
                                  <input type="text" name="waitingTime" value="{{ $pizzaEdit->waiting_time }} MINS" class="form-control">
                              </div>
                              <div class="">
                                  <input type="submit" value="Update" class="btn bg-dark text-white mt-3 float-end">
                              </div>
                          </div>
                        </form>
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
