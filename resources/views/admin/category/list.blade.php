@extends('admin.layout.app')


@section('content')
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  
    <!-- Main content -->
    <section class="content">

      <div class="container-fluid">
        @if (Session::has('addCategory'))
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
            @endif
      
        <div class="row mt-4">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
               <a href="{{ route('addCategory') }}">   <button class="btn btn-sm btn-outline-dark" >Add Category</button></a>
                </h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">

                   <form action="{{ route('searchCategory') }}" method="GET"> <div class="input-group-append">
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
                      <th>Category Name</th>
                      <th>Product Count</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                {{-- @if () --}}
                  
                {{-- @else --}}
                @foreach ($showCategory as $item)
                <tr>
               <td>{{ $item->category_id }}</td>
               <td>{{ $item->category_name }}</td>
               <td>1</td>
                 <td>
                 <a href="{{ route('editCategory',$item->category_id) }}">  <button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button></a>
                   <a href="{{ route('deleteCategory',$item->category_id) }}"><button class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></button></a>
                 </td>
                </tr>
              @endforeach
                {{-- @endif --}}
                   
                  </tbody>
                </table>
                {{ $showCategory->links() }}
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