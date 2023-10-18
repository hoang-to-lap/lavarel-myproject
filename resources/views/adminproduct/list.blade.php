@extends('layouts.admin')
@section('title')
<title>Trang chu</title>
@endsection
@section('css')
<link rel="stylesheet" href="{{asset('admins/product.css')}}">
@endsection
@section('js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="{{asset('admins/product.js')}}"></script>
@endsection
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
@include('partials/content-header' , [
    'name' => 'Product',
    'key' => 'List'
    ])
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
        <a href="{{route('product.create')}}" class="btn  btn-success float-right -mb-2">Thêm sản phẩm</a>
        </div>
        <div class="col-md-12">
          <table class="table">
            <thead>
              <tr>
              <th scope="col">#</th>
                <th scope="col">Tên sản phẩm</th>
                <th scope="col">Giá</th>
                <th scope="col">Hình ảnh</th>
                <th scope="col">Danh mục</th>
                
                <th scope="col">Action</th>
                
           
              </tr>
            </thead>

            <tbody>
           
            @foreach($products as $value)
              <tr>
              <td>{{$value->id}}</td>
                <td>{{$value->name}}</td>
                <td>{{ number_format($value->price) }}</td>
                <td>
                  <img class="image_product" src="{{$value->feature_image_path}}" alt="" srcset="" >
                </td>
                 <td>{{$value->category->name}}</td> 
                <td></td>
                <td>
                  <a href="{{route('product.edit',['id'=>$value->id])}}" class="btn btn-default">Sửa</a>
                   <a href="" 
                   data-url = "{{route('product.delete',['id'=>$value->id])}}"
                   class="btn btn-danger action_delete">Xóa</a>  
                
                </td>
               
              </tr>
         
              @endforeach
            
  
            </tbody>
          </table>
        </div>
        
      
        <!-- /.col-md-6 -->
      </div>
      <!-- /.row -->
      <div class="col-md-12">
          {{$products->links()}}
        </div>
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->
</div>

@endsection