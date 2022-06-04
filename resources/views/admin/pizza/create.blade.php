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
                        <form class="form-horizontal" method="POST" action="{{ route('createPizza') }}">
                            @csrf
                          <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Pizza Name</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="inputName" placeholder="Name" name="name" >
                              @if ($errors->has('name'))
                                  <p class="text-danger">{{ $errors->first('name') }}</p>
                              @endif
                            </div>
                          </div>
                          <div class="form-group row">
                            <label  class="col-sm-2 col-form-label">Pizza Image</label>
                            <div class="col-sm-10">
                              <input type="file" class="form-control" id="inputName" placeholder="Pizza Image" name="image" >
                              @if ($errors->has('image'))
                                  <p class="text-danger">{{ $errors->first('image') }}</p>
                              @endif
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Pizza Price</label>
                            <div class="col-sm-10">
                              <input type="number" class="form-control"  placeholder="Price" name="price" >
                              @if ($errors->has('price'))
                                  <p class="text-danger">{{ $errors->first('price') }}</p>
                              @endif
                            </div>
                          </div>

                          <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Publish Status</label>
                            <div class="col-sm-10">
                             <select name="publish" class="form-control">
                               <option value="0">Publish</option>
                               <option value="1">Unpublish</option>
                             </select>
                              @if ($errors->has('price'))
                                  <p class="text-danger">{{ $errors->first('price') }}</p>
                              @endif
                            </div>
                          </div>

                          <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Category</label>
                            <div class="col-sm-10">
                              <select name="category" class="form-control">
                                <option value="">Choose Option...</option>
                            @foreach ($create as $item)
                           
                           <option value="{{ $item->category_id }}">{{ $item->category_name }}</option>
                           
                            @endforeach
                          </select>
                              @if ($errors->has('price'))
                                  <p class="text-danger">{{ $errors->first('price') }}</p>
                              @endif
                            </div>
                          </div>

                          <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Discount</label>
                            <div class="col-sm-10">
                              <input type="number" class="form-control"  placeholder="Price" name="discount" >
                              @if ($errors->has('discount'))
                                  <p class="text-danger">{{ $errors->first('discount') }}</p>
                              @endif
                            </div>
                          </div>

                          <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Buy One Get One</label>
                            <div class="col-sm-10">
                           <input type="radio" name="buyOneGetOne" class="form-input-check" value="1">No
                           <input type="radio" name="buyOneGetOne" class="form-input-check" value="0">Yes

                              @if ($errors->has('buyOneGetOne'))
                                  <p class="text-danger">{{ $errors->first('buOneGetOne') }}</p>
                              @endif
                            </div>
                          </div>

                          <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Waiting Time</label>
                            <div class="col-sm-10">
                              <input type="number" class="form-control"  placeholder="waitingTime" name="waitingTime" >
                              @if ($errors->has('waitingTime'))
                                  <p class="text-danger">{{ $errors->first('waitingTime') }}</p>
                              @endif
                            </div>
                          </div>

                          <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-10">
                             <textarea name="description"  cols="15" rows="5" class="form-control" style="resize: none"></textarea>
                              @if ($errors->has('description'))
                                  <p class="text-danger">{{ $errors->first('description') }}</p>
                              @endif
                            </div>
                          </div>

                          <div class="form-group row">
                            <div class="offset-sm-2 col-sm-10">
                             <input type="submit" value="Add" class="btn bg-dark text-white">
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
