<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Profile Page</title>
     {{-- Font awesome --}}
     <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
     <!-- CSS only -->
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
 <!-- JavaScript Bundle with Popper -->
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
 
</head>
<body>
    
    <div class="content-wrapper">
        <section class="content">
          <div class="container-fluid">
            <div class="row mt-4">
              <div class="col-8 offset-3 mt-5">
                <div class="col-md-9">
                    <a href="{{ route('user') }}" class="text-decoration-none text-dark "> <i class="fas fa-arrow-left"></i>Back</a>

                  <div class="card">
                    @if (Session::has('updateSuccess'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ Session::get('updateSuccess') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                      @endif
                    <div class="card-header p-2">
                      <legend class="text-center">User Profile</legend>
                    </div>
                    <div class="card-body">
                      <div class="tab-content">
                        <div class="active tab-pane" id="activity">
                          <form class="form-horizontal" method="POST" action="{{ route('userProfileDataChange',Auth()->user()->id) }}">
                            @csrf
                            <div class="form-group row">
                              <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Name" name="name" value="{{ old('name',$profileShow[0]['name'] )}}"><br>
                                @if ($errors->has('name'))
                                <p class="text-danger">{{ $errors->first('name') }}</p>
                                  
                                @endif
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                              <div class="col-sm-10">
                                <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email',$profileShow[0]['email'] )}}"><br>
                                @if ($errors->has('email'))
                                <p class="text-danger">{{ $errors->first('email') }}</p>
                                  
                                @endif
                              </div>
                            </div>
                            {{-- <div class="form-group row">
                              <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                              <div class="col-sm-10">
                                <input name="password" type="password" class="form-control" placeholder="Password" value="{{ old('password',$profileShow->password )}}">
                              </div>
                            </div> --}}
                            <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Phone</label>
                              <div class="col-sm-10">
                                <input type="number" class="form-control" placeholder="Phone" name="phone" value="{{ old('phone',$profileShow[0]['phone'] )}}"><br>
                                @if ($errors->has('phone'))
                                <p class="text-danger">{{ $errors->first('phone') }}</p>
                                  
                                @endif
                              </div>
                            </div>
                            <div class="form-group row">
                              <label  class="col-sm-2 col-form-label">Address</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control"  placeholder="address" name="address" value="{{ old('address',$profileShow[0]['address'] )}}"><br>
                                @if ($errors->has('address'))
                                <p class="text-danger">{{ $errors->first('address') }}</p>
                                  
                                @endif
                              </div>
                            </div>
                        
                            <div class="form-group row">
                              <div class="offset-sm-2 col-sm-10">
                                <a href="{{ route('userProfileChangePassword') }}">Change Password</a>
                              </div>
                            </div>
                            <div class="form-group row">
                              <div class="offset-sm-2 col-sm-10">
                              <input type="submit" value="Update" class="btn bg-dark text-white float-end">
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
    
</body>
</html>