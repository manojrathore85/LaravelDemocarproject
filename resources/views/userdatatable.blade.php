@extends('layouts.app')
@push('styles')
<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css"> -->

@endpush
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">User list </div>
                <div class="card-body">
                    <label for="user"></label>
                    <div class="col-3">
                        <label for="role">Role Name</label>
                        <select id="role" name="role" class="form-select">
                            <option value=" "> </option>
                            @foreach( $roles as $role )
                            <option value="{{$role}}">{{$role}}</option>
                            @endforeach
                        </select>
                    </div>
                    {{ $dataTable->table() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->

<!-- 
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script> -->


{{ $dataTable->scripts(attributes: ['type' => 'module']) }}


<script type="text/javascript">

    document.getElementById("role").addEventListener('change', function() {     window.LaravelDataTables["users-table"].ajax.reload()});
    //  var table = $('#users-table').DataTable({
    //     processing: true,
    //     serverSide: true,
    //     ajax: "{{ route('userview') }}",
    //     columns: [
    //         {data: 'id', name: 'id'},
    //         {data: 'name', name: 'name'},
    //         {data: 'email', name: 'email'},
    //         {
    //            data: 'created_at',
    //            type: 'num',
    //            render: {
    //               _: 'display',
    //               sort: 'timestamp'
    //            }
    //         }
    //     ]
    // });
      

</script> 
@endpush