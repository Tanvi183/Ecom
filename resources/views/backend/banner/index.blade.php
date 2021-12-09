@extends('backend.layouts.admin_layouts')
@section('admin_content')

@section('css')
    <link href="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
@endsection

<div class="card shadow mb-4">
    <div class="col-lg-12">
        @include('backend.includes.notification')
    </div>
    <div class="card-header py-3">
        <h6 class = "m-0 font-weight-bold text-primary" style="float: left">Banner Section</h6>
        <a href="{{ route('admin.banner.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" style="float: right;"><i class="fas fa-plus fa-sm text-white-70"></i>Add New</a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Sl.</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>photo</th>
                    <th>condition</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Sl.</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>photo</th>
                    <th>condition</th>
                    <th>Status</th>
                </tr>
            </tfoot>
            <tbody>
                @php($i = 1)
                @foreach ($banner as $row)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $row->title }}</td>
                        <td>{{ $row->description }}</td>
                        <td><img src="{{ asset('images/'.$row->image) }}" style="height: 80px; width: 120px" /></td>
                        <td>
                            @if ( $row->condition=='banner' )
                                <span class="badge badge-success">{{ $row->condition }}</span>
                            @else
                                <span class="badge badge-primary">{{ $row->condition }}</span>
                            @endif
                        </td>
                        <td>
                            <input type="checkbox" name="toogle" value="{{ $row->id }}" data-toggle="toggle" {{ $row->status == 'active' ? 'checked' : '' }} data-on="Ready" data-off="Not Ready" data-onstyle="success" data-offstyle="danger">
                        </td>
                        <td>
                            <a href="{{ Route('admin.banner.edit',$row->id) }}" class="btn btn-sm btn-info"><span class="fa fa-edit"></span></a>
                            {{-- <a href="{{ Route('slide-delete',['id'=>$slide->id]) }}" onclick="return confirm('if you want ot delete this item please press Ok')" class="btn btn-sm btn-danger"></a> --}}
                            <button type="button" class="btn btn-sm btn-danger" title="Delete">
                                <i onclick="deleteItem({{ $row->id }})" class="fa fa-trash"></i>
                            </button>
                            <form id="delete_form_{{ $row->id }}" method="POST" action="{{ route('admin.banner.destroy', $row->id) }}">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
      </div>
    </div>
  </div>

@section('scripts')
    <!-- Page level plugins -->
    <script src="{{ asset('backend/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <!-- Page level custom scripts -->
    <script src="{{ asset('backend/js/demo/datatables-demo.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>

    <!-- Active and Inactive -->
    <script>
        $('input[name=toogle]').change(function(){
            var mode=$(this).prop('checked');
            var id = $(this).val();
            $.ajax({
                url:"{{ route('admin.banner.status') }}",
                type:"POST",
                data:{
                    _token:'{{ csrf_token() }}',
                    mode:mode,
                    id:id,
                },
                success:function (response){
                    if(response.status){
                        alert(response.msg)
                    }else{
                        alert('Please try again!')
                    }
                }
            })
        });
    </script>
@endsection

@endsection
