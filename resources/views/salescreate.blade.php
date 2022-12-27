@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Sales </div>

                <div class="card-body">
                    <form action="{{url('salescreate')}}" method="post">
                        @csrf
                        <div class="row mb-3">
                            <label for="sale_date" class="col-md-4 col-form-label text-md-end">Sales Date</label>

                            <div class="col-md-6">
                                <input type="date" id="sale_date"  class="form-control" name="sale_date" value="{{ old('sale_date') }}"  autofocus>
          
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
                                <select id="user_id"  class="form-control" name="user_id" value="{{ old('user_id') }}"  autocomplete="user_id" >
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{$user->name}}</option> 
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
                                <select id="car_id"  class="form-control" name="car_id" value="{{ old('car_id') }}"  autocomplete="car_id" >
                                @foreach ($cars as $car)
                                    <option value="{{ $car->id }}">{{$car->name}}</option> 
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
