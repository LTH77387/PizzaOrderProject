@extends('admin.layout.app')


@section('content')
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  
    <!-- Main content -->
    <section class="content">
      <a href="{{ route('orderDownload') }}"><button class="btn bg-success btn-sm text-white mt-4">Download CSV</button></a>

      <div class="container-fluid">

        {{-- @if (Session::has('addCategory'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Session::get('addCategory') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          @endif
          @if (Session::has('updateCategory'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
              {{ Session::get('updateCategory') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            @if (Session::has('deleteCategory'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
              {{ Session::get('deleteCategory') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif --}}
      
        <div class="row mt-4">

          <div class="col-12">

            <div class="card">

              <div class="card-header">

                <h3 class="card-title">
                </h3>
               
                <div class="card-tools">

                  <div class="input-group input-group-sm" style="width: 150px;">
                    <span class="float-right">Total Results- {{ $orderList->total()}}</span><br><br>
                   <form action="{{ route('searchOrder') }}" method="GET"> <div class="input-group-append">
                   @csrf
                   <input type="text" name="searchOrder" class="form-control float-right" placeholder="Search">

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
                      <th>Order ID</th>
                      <th>Customer Name</th>
                      <th>Pizza Name</th>
                      <th>Pizza Count</th>
                      <th>Order Time</th>
                    </tr>
                  </thead>
                  <tbody>
               
                @if ($orderList->total()==0)
                  <tr>
                    <td colspan="5" class="text-muted">There is no result.</td>
                  </tr>
                @else
                @foreach ($orderList as $item)
                <tr>
               <td>{{ $item->order_id }}</td>
               <td>{{ $item->customer_name }}</td>
               <td>{{ $item->pizza_name }}</td>
               <td>{{ $item->count }}</td>
               <td>{{ $item->order_time }}</td>
                {{-- <td>

                  @if ($item->count==0)
                    <a href="#" class="text-decoration-none">{{ $item->count }}</a>

                  @else
                    <a href="{{ route('categoryItem',$item->category_id) }}" class="text-decoration-none">{{ $item->count }}</a>
                  @endif
                </td> --}}
                  {{-- <td>
                 <a href="{{ route('editCategory',$item->category_id) }}">  <button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button></a>
                   <a href="{{ route('deleteCategory',$item->category_id) }}"><button class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></button></a>
                 </td> --}}
                </tr>
              @endforeach
                @endif
             
             
             
                  </tbody>
                </table>
                {{ $orderList->links() }}
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