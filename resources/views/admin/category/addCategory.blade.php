@extends('admin.layout.app')
@section('content')
@extends('admin.layout.app')

@section('content')
    <div class="content-wrapper">

    <section class="content">
   

        <div class="container-fluid">
          <div class="row mt-4">
            <div class="col-8 offset-3 mt-5">

              <div class="col-md-9">
                <a href="{{ route('category') }}" class="text-decoration-none text-dark "> <i class="fas fa-arrow-left"></i>Back</a>

                <div class="card">
                  <div class="card-header p-2">
                    <legend class="text-center">Add Categories</legend>
                  </div>
                  <div class="card-body">
                    <div class="tab-content">
                      <div class="active tab-pane" id="activity">
                        <form class="form-horizontal" method="POST" action="{{ route('createCategory') }}">
                            @csrf
                          <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Category Name</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="inputName" placeholder="Name" name="name" >
                              @if ($errors->has('name'))
                                  <p class="text-danger">{{ $errors->first('name') }}</p>
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
 
@endsection