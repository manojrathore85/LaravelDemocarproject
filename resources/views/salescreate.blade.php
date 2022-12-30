@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Sales </div>

                <div class="card-body">
                    <form id="formSale"
                         @if($sales)
                            action="{{url('salesupdate'.'/'.$sales->id)}}"
                         @else
                             action="{{url('salescreate')}}"
                         @endif
                          method="post">
                        @csrf
                        <div class="row mb-3">
                            <label for="sale_date" class="col-md-4 col-form-label text-md-end">Sales Date</label>

                            <div class="col-md-6">
                                <input type="date" id="sale_date"  class="form-control @error('sale_date') is-invalid @enderror " name="sale_date" value="{{ $sales && $sales->sale_date ? $sales->sale_date : old('sale_date') }}" required  autofocus>
          
                                @error('sale_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Name</label>

                            <div class="col-md-6">
                                <select id="user_id"  class="form-control @error('user_id') is-invalid @enderror" name="user_id" value="{{ old('user_id') }}" required autocomplete="user_id" >
                                @foreach ($users as $user)
                                    <option {{ $sales && $sales->user_id == $user->id ? 'selected'  : ''}} value="{{ $user->id }}">{{$user->name}}</option> 
                                @endforeach    
                            </select>
                                @error('user_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="Car" class="col-md-4 col-form-label text-md-end">Car</label>

                            <div class="col-md-6">
                                <select id="car_id"  class="form-control @error('car_id') is-invalid @enderror" name="car_id" value="{{ old('car_id') }}" required autocomplete="car_id" >
                                @foreach ($cars as $car)
                                    <option {{ $sales && $sales->car_id == $car->id ? 'selected' : '' }} value="{{ $car->id }}">{{$car->name}}</option> 
                                @endforeach    
                            </select>
                                @error('car_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                   Save
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<link rel="stylesheet" href="https://jqueryvalidation.org/files/demo/site-demos.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $("#formSale").validate();
    $('.select').select2({
  placeholder: 'Select an option'
});
</script>
@endpush