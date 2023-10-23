@extends('layoutshop.master')
@section('title')
<title>Our Shop</title>
@endsection
@section('css')
<link rel="stylesheet" href="{{asset('shop/style.css')}}">
<link rel="stylesheet" href="{{asset('shop/login.css')}}">
@endsection
@section('js')
<script src="{{asset('shop/main.js')}}"></script>
@endsection

@section('content')
<div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Login</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="{{route('home.shop')}}">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Shop</p>
            </div>
        </div>
    </div>



<div class="container px-4 py-5 mx-auto">
    <div class="card card0">
        <div class="d-flex flex-lg-row flex-column-reverse">
            <div class="card card1">
                <div class="row justify-content-center my-auto">
                    <div class="col-md-20 col-12 my-5">
                    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                        <div class="row justify-content-center px-3 mb-3">
                   
                        </div>
                        <h3 class="mb-5 text-center heading">We are EShopper</h3>

                        <h6 class="msg-info">Please login to your account</h6>
                       <form action="{{route('dangnhap.user')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label class="form-control-label text-muted">Username</label>
                            <input type="text" id="email" name="user_name" class="form-control">
                        </div>

                        <div class="form-group">
                            <label class="form-control-label text-muted">Password</label>
                            <input type="password" id="psw" name="password"  class="form-control">
                        </div>

                        <div class="row justify-content-center my-3 px-3">
                            <button class="btn-block btn-color" type="submit">Login </button>
                        </div>
                        </form>
                      
                    </div>
                </div>
              
            </div>

        </div>
    </div>
</div>
   


@endsection