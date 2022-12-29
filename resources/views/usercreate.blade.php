@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">UserCreate
                <a href="/userview" class="btn btn-primary btn-sm float-end">List</a>

                </div>

                <div class="card-body">
                    <form 
                        @if($user->id > 0 )
                        action="{{url('useredit'.'/'.$user->id)}}" method="post"
                        @else
                        action="{{url('usercreate')}}" method="post"
                        @endif 
                        >
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name ? $user->name : old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email ? $user->email : old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        @if(empty($user->id) )
                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        @endif
                        <div class="row mb-3">
                            <label for="address" class="col-md-4 col-form-label text-md-end">Address</label>
                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control" name="address"  value="{{ $user->address ? $user->address : old('address') }}">
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="phone" class="col-md-4 col-form-label text-md-end">Phone Number</label>

                            <div class="col-md-6">
                                <!-- <input id="phone" type="number" class="form-control" name="phone"  value="{{ old('phone') }}" min="1111111111" max="9999999999"> -->
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{$user->phone ? $user->phone : old('phone') }}" >
                               
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="role" class="col-md-4 col-form-label text-md-end">User Role</label>
                            <div class="col-md-6">                               
                                <select id="role" class="form-control" name="role" required>
                                    @php 
                                       
                                        if($user->id > 0)
                                            $role = $user->getRoleNames()[0];
                                        else
                                            $role = '0';
                                    @endphp
                                   
                                    <option {{ $role == "admin" ? "selected" : " "  }} value="admin">Admin</option>
                                    <option {{ $role == "merchant" ? "selected" :" "  }} value="merchant">Merchant</option>
                                    <option {{ $role == "customer" ? "selected" : " " }} value="customer">Customer</option>
                                </select>   
                                @error('role')
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
