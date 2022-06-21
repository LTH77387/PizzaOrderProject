<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Change Passowrd Page</title>
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
                    <a href="{{ route('userProfileShow',Auth()->user()->id) }}" class="text-decoration-none text-dark "> <i class="fas fa-arrow-left"></i>Back</a>
                  <div class="card">
                    @if (Session::has('updateSuccess'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ Session::get('updateSuccess') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                      @endif
                      {{-- old pw does not match error --}}
                      @if (Session::has('oldPasswordErr'))
                      <div class="alert alert-warning alert-dismissible fade show" role="alert">
                          {{ Session::get('oldPasswordErr') }}
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        {{-- passwords do not match --}}
                        @if (Session::has('notMatch'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        {{ Session::get('notMatch') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                      @endif
                      {{-- length error --}}
                      @if (Session::has('lengthErr'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        {{ Session::get('lengthErr') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                      @endif
                      {{-- pw chg success --}}
                      @if (Session::has('success'))
                      <div class="alert alert-success alert-dismissible fade show" role="alert">
                          {{ Session::get('success') }}
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                    <div class="card-header p-2">
                      <legend class="text-center">User Change Password</legend>
                    </div>
                    <div class="card-body">
                      <div class="tab-content">
                        <div class="active tab-pane" id="activity">
                          <form class="form-horizontal" method="POST" action="{{ route('userRealPasswordChange',auth()->user()->id) }}">
                            @csrf

                          

                            <div class="form-group row">
                              <label for="inputName" class="col-sm-2 col-form-label">Old Password :</label>
                              <div class="col-sm-10">
                                <input type="password" class="form-control" name="oldPassword"   value=""><br>
                                @if ($errors->has('oldPassword'))
                                    <p class="text-danger">{{ $errors->first('oldPassword') }}</p>
                                @endif
                               
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="inputEmail" class="col-sm-2 col-form-label">New Password :</label>
                              <div class="col-sm-10">
                                <input type="password" class="form-control" name="newPassword"  name="email" value=""><br>
                                @if ($errors->has('newPassword'))
                                <p class="text-danger">{{ $errors->first('newPassword') }}</p>
                            @endif
                              </div>
                            </div>
                           
                            <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Confirm Password :</label>
                              <div class="col-sm-10">
                                <input type="password" class="form-control" name="confirmPassword" value=""><br>
                                @if ($errors->has('confirmPassword'))
                                <p class="text-danger">{{ $errors->first('confirmPassword') }}</p>
                            @endif
                              
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