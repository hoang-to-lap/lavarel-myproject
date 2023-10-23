@extends('layoutshop.master')
@section('title')
<title>Our Shop</title>
@endsection
@section('css')
<link rel="stylesheet" href="{{asset('shop/style.css')}}">
@endsection
@section('js')
<script src="{{asset('shop/main.js')}}"></script>

@endsection

@section('content')

<div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Product Detail</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="{{route('home.shop')}}">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">My Cart</p>
            </div>
        </div>
    </div>
   
<div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-bordered text-center mb-0">
                    <thead class="bg-secondary text-dark">
                        <tr>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Size</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach($item as $productcart)
                        <tr>
                            <td class="align-middle"><img src="{{$productcart->attributes->iamge}}" alt="" style="width: 50px;"> {{$productcart->name}}</td>
                            <td class="align-middle">{{number_format($productcart->price)}}</td>
                            <td class="align-middle">{{$productcart->attributes->size}}</td>
                            <td class="align-middle">
                                <div class="input-group quantity mx-auto" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <a href="{{route('updatecart.giam',['id' => $productcart->id])}}" type="button" class="btn btn-sm btn-primary btn-minus " >
                                        <i class="fa fa-minus"></i>
                                        </a>
                                    </div>
                                    <input type="text" class="form-control form-control-sm bg-secondary text-center" value="{{$productcart->quantity}}" onchange="updateCart(this.value,'{{$productcart->id}}')">
                                    <div class="input-group-btn">
                                        <a href="{{route('updatecart.tang',['id' => $productcart->id])}}" type="button"   class="btn btn-sm btn-primary btn-plus">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle">{{number_format($productcart->price * $productcart->quantity)}}</td>
                            <td class="align-middle"><a href="{{route('deletecart',['id'=> $productcart->id])}}" class="btn btn-sm btn-primary"><i class="fa fa-times"></i></a></td>
                        </tr>
  @endforeach

                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <form class="mb-5" action="">
                    <div class="input-group">
                        
                        <div class="input-group-append">
                            <a href="{{route('clearcart')}}" class="btn btn-primary">Xóa giỏ hàng</a>
                        </div>
                    </div>
                </form>
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Cart Summary</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3 pt-1">
                            <h6 class="font-weight-medium">Subtotal</h6>
                            <h6 class="font-weight-medium">{{number_format($sub)}}</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium">Free</h6>
                        </div>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Total</h5>
                            <h5 class="font-weight-bold">{{number_format($total)}} VND</h5>
                        </div>
                        <button class="btn btn-block btn-primary my-3 py-3">Proceed To Checkout</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection



