@extends('layouts.admin')
@section('title')
<title>Trang chu</title>
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
           
            
              <tr>
                <th scope="row"></th>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                  <a href="" class="btn btn-default">Sửa</a>
                   <a href="" class="btn btn-danger">Xóa</a>  
                
                </td>
               
              </tr>
         
   
            
  
            </tbody>
          </table>
        </div>
      
        <!-- /.col-md-6 -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->
</div>

@endsection