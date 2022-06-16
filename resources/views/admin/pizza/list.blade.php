@extends('admin.layout.app')
@section('content')


  
  <div class="content-wrapper">


    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
       
        @if (Session::has('deletePizza'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Session::get('deletePizza') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          @endif
          {{-- pizza update --}}
          @if (Session::has('updatePizzaData'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Session::get('updatePizzaData') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          @endif
        <div class="row mt-4">
          <div class="col-12">
            <div class="card">
              <a href="{{ route('pizzaDownload') }}"><button class="btn bg-success text-white float-end mt-3">Download CSV</button></a>

              <a href="{{ route('pizzaCreate') }}" class="text-decoration-none text-dark"><button class="btn-lg bg-dark"><i class="fas fa-plus"></i></button></a>
              <div class="card-header">
                <h3 class="card-title">Pizza Table</h3>
               
                <div class="card-tools">
                  <span class="float-right mr-3">Total Results- {{ $pizzaShow->total()}}</span><br><br>
                 <form action="{{ route('pizzaSearch') }}" method="GET">
                   @csrf
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                 </form>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap text-center">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Pizza Name</th>
                      <th>Image</th>
                      <th>Price</th>
                      <th>Publish Status</th>
                      <th>Buy 1 Get 1 Status</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                @if ($status==0)
                  <tr>
                    <td colspan="7">
                      <small class="text-muted">There is no data.</small>
                    </td>
                  </tr>
                @else
                @foreach ($pizzaShow as $item)
                <tr>
                  <td>{{ $item->pizza_id}}</td>
                  <td>{{ $item->pizza_name }}</td>
                  <td>
                    <img src="{{ asset('/uploads/' . $item->image) }}" class="img-thumbnail" width="100px" height="100px">
                  </td>
                  <td>{{ $item->price }} kyats</td>
                  <td>
                    @if ($item->publish_status==0)
                    Unpublish
                      @elseif ($item->publish_status==1)
                      Publish
                    @endif
                  </td>
                  <td>
                  @if ($item->buy_one_get_one_status==0)
                    Yes
                    @elseif ($item->buy_one_get_one_status==1)
                    No
                  @endif  
                  </td>
                  <td>
                   <a href="{{ route('pizzaEdit',$item->pizza_id) }}"> <button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button></a>
                    <a href="{{ route('deletePizza',$item->pizza_id) }}"><button class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></button></a>
                    <a href="{{ route('pizzaInfo',$item->pizza_id) }}"><button class="btn btn-sm bg-dark text-white"><i class="fas fa-eye"></i></button>
                    </a>
                  </td>
                </tr>
                @endforeach
                @endif
                    
                  </tbody>
                </table>
                {{ $pizzaShow->links() }}
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
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

<!-- ./wrapper -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
</body>
</html>

  
@endsection