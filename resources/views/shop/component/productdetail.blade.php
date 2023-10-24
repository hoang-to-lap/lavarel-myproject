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

     <!-- Page Header Start -->
     <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Product Detail</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="{{route('home.shop')}}">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Shop Detail</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Shop Detail Start -->
    <div class="container-fluid py-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 pb-5">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner border">
                   
                        <div class="carousel-item active">
                           
                            <img class="w-100 h-100" src="{{$product->feature_image_path}}" alt="Image">
                        </div>
                       
                        @foreach($product->productimage as $item)
                        <div class="carousel-item">
                            <img class="w-100 h-100" src="{{$item->image_path}}" alt="Image">
                        </div>
                        @endforeach
                       
                      
                    </div>
                    <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                        <i class="fa fa-2x fa-angle-left text-dark"></i>
                    </a>
                    <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                        <i class="fa fa-2x fa-angle-right text-dark"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-7 pb-5">
                <h3 class="font-weight-semi-bold">{{$product->name}}</h3>
                <div class="d-flex mb-3">
                    <div class="text-primary mr-2">
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star-half-alt"></small>
                        <small class="far fa-star"></small>
                    </div>
                    <small class="pt-1">(50 Reviews)</small>
                </div>
                <h3 class="font-weight-semi-bold mb-4">{{number_format($product->price)}} VND</h3>
                <p class="mb-4">Danh Muc :  {{$product->category->name}}</p>
                <div class="d-flex mb-3">
                <form action="{{route('addcart' , ['id'=>$product->id])}}" method="post">
                    @csrf
                    <p class="text-dark font-weight-medium mb-0 mr-3">Sizes:</p>
                   
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="size-1" name="size" value="XS">
                            <label class="custom-control-label" for="size-1">XS</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="size-2" name="size" value="S">
                            <label class="custom-control-label" for="size-2">S</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="size-3" name="size" value="M">
                            <label class="custom-control-label" for="size-3">M</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="size-4" name="size" value="L">
                            <label class="custom-control-label" for="size-4">L</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="size-5" name="size" value="XL">
                            <label class="custom-control-label" for="size-5">XL</label>
                        </div>
                
                </div>
            
                <div class="d-flex align-items-center mb-4 pt-2">
                    <div class="input-group quantity mr-3" style="width: 130px;">
                        <div class="input-group-btn">
                            
                            
                         
                        </div>
                      
                  
                      <input type="hidden" class="form-control bg-secondary text-center" name="product_id" value="{{$product->id}}">
                        <div class="input-group-btn">
                          
                        </div>
                    </div>
                    <button class="btn btn-primary px-3" type="submit"><i class="fa fa-shopping-cart mr-1"></i> Add To Cart</button>
                </div>
                </form>
                <div class="d-flex pt-2">
                    <p class="text-dark font-weight-medium mb-0 mr-2">Share on:</p>
                    <div class="d-inline-flex">
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-pinterest"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row px-xl-5">
            <div class="col">
                <div class="nav nav-tabs justify-content-center border-secondary mb-4">
                    <a class="nav-item nav-link active" data-toggle="tab" href="#tab-pane-1">Description</a>
              
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-pane-1">
                        <h4 class="mb-3">Product Description</h4>
                     {{$product->content}}
                       
                    </div>
              
                </div>
            </div>
        </div>
    </div>
   
@endsection



