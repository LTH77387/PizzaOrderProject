@extends('admin.layout.app')


@section('content')
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  
    <!-- Main content -->
    <section class="content">

      <div class="container-fluid">
       
      
        <div class="row mt-4">
          <a href="{{ route('contactDownload') }}"><button class="btn bg-success text-white float-end my-3">Download Contact CSV</button></a>

          <div class="col-12">
            <h4 class="text-center">{{ $contact['name'] }}</h4>
            {{-- <a href="" class="text-decoration-none text-dark "> <i class="fas fa-arrow-left"></i>Back</a> --}}
      
            <div class="card">
                
              <div class="card-header">
                <h3 class="card-title">
         
                </h3>
               
                <div class="card-tools">
                 
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <span class="float-right">Total Results- {{ $contact->total()}}</span><br><br>
                   <form action="{{ route('searchContact') }}" method="GET"> <div class="input-group-append">
                   @csrf
                   <input type="text" name="searchContact" class="form-control float-right" placeholder="Search">

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
                        <th>Contact ID</th>
                      <th>Contact Name</th>
                      <th>User ID</th>
                      <th>Contact Email</th>
                      <th>Contact Message</th>
                      
                    </tr>
                  </thead>
                  <tbody>
            @if ($contact->total()==0)
                <tr>
                    <td colspan="5">No Results!</td>
                </tr>
            @else
            @foreach ($contact as $item)
            <tr>
                <td>{{ $item->contact_id }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->user_id }} </td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->message }}</td>
            </tr>
                
            @endforeach
            @endif
              
             
             
             
                  </tbody>
                </table>
                {{ $contact->links() }}
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