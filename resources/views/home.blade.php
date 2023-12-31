@extends('layouts.admin')
@section('title')
<title>Trang chu</title>
@endsection

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
 @include('partials/content-header' , [
  'name' => 'Home',
  'key' => 'Home'
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
        Trang chu
        </div>
        <!-- /.col-md-6 -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->
</div>
@endsection