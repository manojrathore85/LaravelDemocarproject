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
                <div class="card-header">Sales list </div>
                <div class="card-body">
                    <label for="user"></label>
                    <div class="col-3">
                        <label for="merchant" >Merchant Name</label>
                        <select id="merchant" name="merchant" class="form-select" >
                        <option value=" "> </option>
                        @foreach( $merchants as $merchant )    
                        <option value="{{$merchant->id}}">{{$merchant->name}}</option>
                        @endforeach
                    </select></div>
                    <table id="saleslist">
                           <thead>
                            <tr>
                            <th>Sn</th>
                            <th>Date</th>
                            <th>Customer</th>
                            <th>Car</th>
                           
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
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->


<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>





<script type="text/javascript">
  $(function () {
      
    var table = $('#saleslist').DataTable({
        processing: true,
        serverSide: true,
       // ajax: "{{ route('userview') }}",
        ajax: {
            url: "{{ route('salesview') }}",
            method:'get',
            data: function (d) {                
                d.merchant = $("#merchant").val();
                // etc
            },
        },
        columns: [
            {data: 'id', name: 'id'},
            {data: 'sale_date', name: 'sale_date'},
            {data: 'customername', name: 'customername'},
            {data: 'carname', name: 'carname'},
            
          
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

    $("#merchant").change(function (){
        table.ajax.reload();
    });
      
  });
</script>
@endpush
