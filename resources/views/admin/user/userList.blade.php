@extends('admin.layout.app')


@section('content')
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  
    <!-- Main content -->
    <section class="content">

      <div class="container-fluid">
       @if (Session::has('userListDelete'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ Session::get('userListDelete') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          @endif
         
      
        <div class="row mt-4">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                    <a href="{{ route('getUserListPage') }}">   <button class="btn btn-sm btn-outline-dark" >User Page</button></a>
                    <a href="{{ route('getAdminListPage') }}">   <button class="btn btn-sm btn-outline-dark" >Admin Page</button></a>
     
                </h3>

                <div class="card-tools">
                  <span class="float-right">Total Results- {{ $userList->total()}}</span><br><br>
                  <div class="input-group input-group-sm" style="width: 150px;">

                   <form action="{{ route('userListSearch') }}" method="GET"> <div class="input-group-append">
                   @csrf
                   <input type="text" name="ListSearch" class="form-control float-right" placeholder="Search">

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
                      <th>User Name</th>
                      <th>User Email</th>
                      <th>User Phone</th>
                      <th>User Address</th>
                    </tr>
                  </thead>
                  <tbody>
                 @if ($userList->total()==0)
                 <tr>
                   <td colspan="5">
                     <span class="text-muted">No Results!</span>
                   </td>
                 </tr>

                   @else
                   @foreach ($userList as $item)
                   <tr>
                       <td>{{ $item->id }}</td>
                  <td>{{ $item->name }}</td>
                  <td>{{ $item->email }}</td>
                  <td>{{ $item->phone }}</td>
                  <td>{{ $item->address }}</td>
                  <td>
 
                     <a href="{{ route('userListDelete',$item->id) }}"><button class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></button></a>
                   </td>
 
                   </tr>
                 @endforeach
                 @endif
                
                 
                 
            
                  
                 
                 
                
                 
              
                 
                   
                  </tbody>
                </table>
                {{-- {{ $userList->links() }} --}}
                {{-- {{ $showCategory->links() }} --}}
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