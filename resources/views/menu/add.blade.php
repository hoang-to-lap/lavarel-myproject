@extends('layouts.admin')
@section('title')
<title>Trang chu</title>
@endsection

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
 @include('partials/content-header' , ['name' => 'Menu',
 'key' => 'Add'
 
 ])
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
 <!-- Form them danh muc san pham  -->
 <div class="col-md-12">
 <form action="{{route('menu.store')}}" method="post">
  @csrf
  <div class="mb-3">
    <label  class="form-label">Them Menu</label>
    <input  class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name = "txtName">
    <div class="mb-3 mt-3">
      <label  class="form-label">Menu cha</label>
      <select  class="form-select" name="txtParent_id">
        <option value="0">Chọn Menu cha</option>
        {!!$htmlOption!!}
      </select>
    </div>
  </div>


  <button type="submit" class="btn btn-primary">Thêm Menu</button>
</form>
 </div>
        <!-- /.col-md-6 -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->
</div>
@endsection