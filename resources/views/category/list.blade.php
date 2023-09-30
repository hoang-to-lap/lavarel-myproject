@extends('layouts.admin')
@section('title')
<title>Trang chu</title>
@endsection

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
@include('partials/content-header' , [
    'name' => 'Category',
    'key' => 'List'
    ])
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
        <a href="{{route('categories.create')}}" class="btn  btn-success float-right -mb-2">Thêm danh mục</a>
        </div>
        <div class="col-md-12">
          <table class="table">
            <thead>
              <tr>
              <th scope="col">#</th>
                <th scope="col">Tên danh mục</th>
                <th scope="col">Action</th>
                
           
              </tr>
            </thead>

            <tbody>
              @foreach($list as $value)
              <tr>
                <th scope="row">{{$value->id}}</th>
                <td>{{$value->name}}</td>
                <td>
                  <a href="{{route('categories.edit' , ['id' => $value->id])}}" class="btn btn-default">Sửa</a>
                  <a href="{{route('categories.delete',['id' => $value->id])}}" class="btn btn-danger">Xóa</a>
                </td>
               
              </tr>
          
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="col-md-12">
          {{$list->links()}}
        </div>
        <!-- /.col-md-6 -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->
</div>
@endsection