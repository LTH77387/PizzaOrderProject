@extends('admin.layout.app')


@section('content')
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  
    <!-- Main content -->
    <section class="content">

      <div class="container-fluid">
       
      
        <div class="row mt-4">
          <div class="col-12">
            <h4 class="text-center">{{ $categoryItem[0]->categoryName }}</h4>
            <a href="{{ route('category') }}" class="text-decoration-none text-dark "> <i class="fas fa-arrow-left"></i>Back</a>
      
            <div class="card">
                
              <div class="card-header">
                <h3 class="card-title">
         
                </h3>
               
                <div class="card-tools">
                 
                  <div class="input-group input-group-sm" style="width: 150px;">
                    {{-- <span class="float-right">Total Results- {{ $showCategory->total()}}</span><br><br> --}}
                   <form action="" method="GET"> <div class="input-group-append">
                   @csrf
                   <input type="text" name="searchCategory" class="form-control float-right" placeholder="Search">

                    <button type="submit" class="btn btn-default">
                      <i class="fas fa-search"></i>
                    </button>
                  </div></form>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap text-center">
                 
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Image</th>
                      <th>Pizza Name</th>
                      <th>Pizza Price</th>
                      
                    </tr>
                  </thead>
                  <tbody>
               @foreach ($categoryItem as $item)
               <tr>
                   <td>{{ $item->pizza_id }}</td>
                   <td>
                       <img src="{{ asset('uploads/' . $item->image) }}" width="150px" height="150px">
                   </td>
                   <td>{{ $item->pizza_name }}</td>
                   <td>{{ $item->price }}</td>
               </tr>
                   
               @endforeach
              
             
             
             
                  </tbody>
                </table>
                {{ $categoryItem->links() }}
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection