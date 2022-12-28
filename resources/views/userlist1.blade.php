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
                <div class="card-header">User list
                    <div class="float-end">
                        <a href="/usercreate" class="btn btn-primary btn-sm ">Create Users</a>
                        <a href="/create10user" class="btn btn-primary btn-sm ">Create 10 Rendom Users</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <label for="role">Role Name</label>
                        <div class="col-3">

                            <select id="role" name="role" class="form-select">
                                <option value=" "> </option>
                                @foreach( $roles as $role )
                                <option value="{{$role}}">{{$role}}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <table id="userlist">
                        <thead>
                            <tr>
                                <th>Sn</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>CreateAt</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> --> -->


<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>





<script type="text/javascript">
    $(function() {

        var table = $('#userlist').DataTable({
            processing: true,
            serverSide: true,
            // ajax: "{{ route('userview') }}",
            ajax: {
                url: "{{ route('userview') }}",
                method: 'get',
                data: function(d) {
                    d.role = $("#role").val();
                    // etc
                },
            },
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'address',
                    name: 'address'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'phone',
                    name: 'phone'
                },
                {
                    data: 'updated_at',
                    name: 'updated_at'
                },
                {
                    data: 'action',
                    name: 'Action'
                },
                // {
                //    data: 'created_at',
                //    type: 'num',
                //    render: {
                //       _: 'display',
                //       sort: 'timestamp'
                //    }
                // }
            ],
            buttons: [
                // 'colvis',
                // 'excel',
                // 'print'
            ]
        });

        $("#role").change(function() {
            table.ajax.reload();
        });

    });
</script>
@endpush