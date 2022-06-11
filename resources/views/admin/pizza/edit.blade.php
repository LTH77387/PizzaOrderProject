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
                <form action="{{ route('updatePizza',$pizzaEdit->pizza_id) }}" method="POST" enctype="multipart/form-data">
                  @csrf
                <div class="card">
                  <div class="card-header p-2">
                    <legend class="text-center">Edit Pizza</legend>
                  </div>
                  <div class="card-body">
                    <div class="tab-content">
                      <div class="active tab-pane" id="activity">
                     <div class="text-center">
                        <img src="{{ asset('/uploads/' . $pizzaEdit->image) }}" class="img-thumbnail" width="100px" height="100px" class="rounded-circle" style="border-radius: 30px" name="image">
                    </div>
                       
                          <div class="">
                            <div class="">
                              <input type="file" name="image"  class="form-control">
                            </div>
                              <div class="">
                                  <label >Pizza Name:</label>
                                  <input type="text" name="name" value="{{ old('name',$pizzaEdit->pizza_name) }}" class="form-control">
                                  @if ($errors->has('name'))
                                  <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                              </div>
                              <div class="">
                                  <label>Description:</label> 
                                  <input type="text" name="description" value="{{ old('description', $pizzaEdit->description ) }}" class="form-control">
                                  @if ($errors->has('description'))
                                  <span class="text-danger">{{ $errors->first('description') }}</span>
                                @endif
                              </div>
                              <div class="">
                                  <label>Price:</label> 
                                  <input type="text" name="price" value="{{ old('price',$pizzaEdit->price ) }}" class="form-control">
                                  @if ($errors->has('price'))
                                  <span class="text-danger">{{ $errors->first('price') }}</span>
                                @endif
                              </div><br>
                              <div class="">
                                  <label>Publish Status:</label>
                                  {{-- @if ($pizzaEdit->publish==0)
                                      Publish
                                  @else
                                      Unpublish
                                  @endif --}}
                                  <select name="publish" class="form-control">
                                    @if ($pizzaEdit->publish_status==0)
                                    <option value="0" selected>Publish</option>
                                    <option value="1">Unpublish</option>
                                    @else
                                    <option value="0" >Publish</option>
                                    <option value="1" selected>Unpublish</option>
                                    @endif
                                  </select>
                                 
                              </div>
                              <div class="">
                                  <label>Category :</label>
                              <select name="category" id="" class="form-control">
                                {{-- <option value="">Choose Options...</option> --}}
                                @foreach ($category as $item)
                            
                                  @if ($item->category_id != $pizzaEdit->category_id)
                                  <option value="{{ $item->category_id }}" >{{ $item->category_name }}</option>
                                  @else{
                                    <option value="{{ $item->category_id }}" selected>{{ $item->category_name }}</option>
                                  }
                                  @endif
                                @endforeach
                              </select>
                              </div><br>
                              <div class="">
                                  <label>Discount:</label>
                                  <input type="text" name="discount" value="{{ old('discount',$pizzaEdit->discount_price) }} " class="form-control"><br>
                                  @if ($errors->has('discount'))
                                    <span class="text-danger">{{ $errors->first('discount') }}</span>
                                  @endif
                              </div>
                              <div class="col-sm-10">
                                <label>Buy 1 Get 1</label>
                                {{-- @if ($pizzaEdit->buy_one_get_one_status==0)
                                <input type="radio" name="buyOneGetOne" class="form-input-check" value="0" checked class="form-control">Yes
                                <input type="radio" name="buyOneGetOne" class="form-input-check" value="1">No
                                @else
                                <input type="radio" name="buyOneGetOne" class="form-input-check" value="0">Yes
                                <input type="radio" name="buyOneGetOne" class="form-input-check" value="1" class="form-control">checked>No
                                @endif --}}
                           <select name="buy_one_get_one_status" class="form-control">
                             @if ($pizzaEdit->buy_one_get_one_status==0)
                             <option value="0" selected>Yes</option>
                               <option value="1">No</option>
                               @else
                               <option value="0" >Yes</option>
                               <option value="1" selected>No</option>
                             @endif
                           </select>
                           
     
                                   @if ($errors->has('buyOneGetOne'))
                                       <p class="text-danger">{{ $errors->first('buOneGetOne') }}</p>
                                   @endif
                                 </div>
                              
                              <div class="">
                                  <label>Waiting Time:</label>
                                  <input type="text" name="waitingTime" value="{{ old('waitingTime',$pizzaEdit->waiting_time) }} " class="form-control">
                                  @if ($errors->has('waitingTime'))
                                  <span class="text-danger">{{ $errors->first('waitingTime') }}</span>
                                @endif
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
