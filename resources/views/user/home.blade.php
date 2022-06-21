@extends('user.layouts.style')
@section('style')

      <!-- Responsive navbar-->
      <nav class="navbar navbar-expand-lg navbar-white bg-secondary sticky-top">
        <div class="container px-5">
            <a class="navbar-brand" href="#!">Pizza Order System</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#!">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Pizza</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                   
                  <form action="{{ route('logout') }}" method="POST">
                      @csrf
                      <li class="nav-item"><button class="nav-link btn btn-sm btn-outline-danger" type="submit">Logout</button></li>
                  </form>
                 <li class="nav-item">
                    <button type="button" class="btn btn-primary position-relative ml-4">
                        <img src="{{ asset('assets/shopping-cart copy.png') }}" alt="" width="30px" height="30px">
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="display">
                         0
                          <span class="visually-hidden">unread messages</span>
                        </span>
                      </button>
                 </li>
         
                <li class="nav-item">
                   <a href="{{ route('userProfileShow',Auth()->user()->id) }}">
                    <button type="button" class="btn btn-primary position-relative ml-4">
                        Profile
                     
                        
                          <span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">
                             
                         </span>
                       </button>
                   </a>
                 </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page Content-->
    <div class="container px-4 px-lg-5" id="home">
      
        <!-- Heading Row-->
        <div class="row gx-4 gx-lg-5 align-items-center my-5">
            <div class="col-lg-7"><img class="img-fluid rounded mb-4 mb-lg-0" id="code-lab-pizza" src="https://www.pizzamarumyanmar.com/wp-content/uploads/2019/04/chigago.jpg" alt="..." /></div>
            <div class="col-lg-5">
                <h1 class="font-weight-light">Ready to Eat?</h1>
                <p>This is a template that is great for small businesses. It doesn't have too much fancy flare to it, but it makes a great use of the standard Bootstrap core components. Feel free to use this template for any project you want!</p>
                <a class="btn btn-primary" href="#!">Enjoy!</a>
            </div>
        </div>

        <!-- Content Row-->
        <div class="d-flex justify-content-around">
        
            <div class="col-3 me-5">
               
                <div class="">
                    <div class="py-5 text-center">
                       
                        <form class="d-flex m-5" method="GET" action="{{ route('userCategorySearch') }}">
                           @csrf
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="userCategorySearch">
                            <button class="btn btn-outline-dark" type="submit" >Search</button>
                        </form>

                        <div class="">
                            <div class="m-2 p-2"><a href="{{ route('user') }}" class="text-decoration-none text-dark">All</a></div>
                            @foreach ($categoryData as $item)
                            <div class="m-2 p-2"><a href="{{ route('userCategory',$item->category_id) }}" class="text-decoration-none text-dark">{{ $item->category_name }}</a></div>
                                
                            @endforeach
                        </div>
                        <hr>
                        <div class="text-center m-4 p-2">
                            <h3 class="mb-3">Start Date - End Date</h3>

                            <form>
                                <input type="date" name="" id="" class="form-control"> -
                                <input type="date" name="" id="" class="form-control">
                            </form>
                        </div>
                        <hr>
                        <div class="text-center m-4 p-2">
                            <h3 class="mb-3">Min - Max Amount</h3>

                            <form method="GET" action="{{ route('dateSearch') }}">
                                @csrf
                                <input type="number" name="minPrice" id="" class="form-control" placeholder="minimum price" value="{{ old('minPrice') }}"> -
                                <input type="number" name="maxPrice" id="" class="form-control" placeholder="maximun price" value="{{ old('maxPrice') }}"><br>
                                <input type="submit" value="Search" class="btn bg-dark text-white">
                            </form>
                        </div>
                    </div>
                </div>
               
            </div>
            <div class="mt-5">
              
                <div class="row gx-4 gx-lg-5" id="pizza">
                   @if ($count==0)
                    <p class="text-center text-danger">There is no pizza data.</p>

                   @else
                   @foreach ($pizza as $item)
                   <div class="col-md-6 mb-5">
                       <div class="card h-100" style="width: 270px">
                           <!-- Sale badge-->
                           @if ($item->buy_one_get_one_status==0)
                           <div class="badge bg-danger
                            text-white position-absolute" style="top: 0.5rem; right: 0.5rem">
                               Buy 1 Get 1
                          
                           </div>
                           @endif
                           <!-- Product image-->
                           <img class="card-img-top" src="{{ asset('uploads/' . $item->image) }}" alt="...">
                           <!-- Product details-->
                           <div class="card-body p-4">
                               <div class="text-center">
                                   <!-- Product name-->
                                   <h5 class="fw-bolder">{{ $item->pizza_name }}</h5>
                                   <!-- Product price-->
                                   <span class="text-muted text-decoration-line-through">{{ $item->price }}</span> {{ $item->price - $item->discount_price }} 
                                   <span class="fs-5"> <b>MMK</b></span>
                               </div>
                           </div>
                           <!-- Product actions-->
                          <div class="" id="btn">
                           <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                               <div class="text-center"><button  class="btn btn-outline-dark mt-auto">Add To Cart</button></div><br>
                          <div class="text-center"> <a href="{{ route('pizzaDetails',$item->pizza_id) }}"><button class="btn bg-light text-dark">More Detials</button></a></div>
                           </div>
                          
                          </div>
                        
                       </div>
                   </div>
                   @endforeach
                   @endif
                 

            

                    

               
                </div>
            </div>
        </div>
    </div>
    <form action="{{ route('userSend',auth()->user()->id) }}" class="my-4">
        @csrf
    <div class="text-center d-flex justify-content-center align-items-center" id="contact">

        <div class="col-4 border shadow-sm ps-5 pt-5 pe-5 pb-2 mb-5">
            @if (Session::has('contactSend'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Session::get('contactSend') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          @endif
            <h3>Contact Us</h3>

           
             
                <input type="text" name="name" id="" class="form-control my-3" placeholder="Name">
                @if ($errors->has('name'))
                <p class="text-danger">{{ $errors->first('name') }}</p>
            @endif
                <input type="text" name="email" id="" class="form-control my-3" placeholder="Email">
                @if ($errors->has('email'))
                <p class="text-danger">{{ $errors->first('email') }}</p>
            @endif
                <textarea class="form-control my-3" id="exampleFormControlTextarea1"  rows="3" placeholder="Message" name="message" style="resize: none"></textarea>
                @if ($errors->has('message'))
                <p class="text-danger">{{ $errors->first('message') }}</p>
            @endif
            <input type="submit" value="Send" class="btn bg-dark text-white">
            </form>
        </div>
    </div>

  
  
@endsection