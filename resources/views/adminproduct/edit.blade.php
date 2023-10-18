@extends('layouts.admin')
@section('title')
<title>Trang chu</title>
@endsection



@section('css')
<link rel="stylesheet" href="{{asset('admins/product.css')}}">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="../../css/admin/add.css">
@endsection


@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
 @include('partials/content-header' , ['name' => 'Product',
 'key' => 'Edit'
 
 ])
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
 <!-- Form them danh muc san pham  -->
 <div class="col-md-12">
 <form action="{{route('product.update', ['id'=>$product->id])}}" method="post" enctype="multipart/form-data">
  @csrf
  <div class="mb-3">
    <label  class="form-label">Tên sản phẩm</label>
    <input  class="form-control" id="exampleInputEmail1"  name = "txtName" value="{{$product->name}}">
    <label  class="form-label">Giá sản phẩm</label>
    <input  class="form-control" id="exampleInputEmail1" name = "txtPrice" value="{{$product->price}}">
    <label  class="form-label">Ảnh sản phẩm</label>
    <div><img class="image_product" src="{{$product->feature_image_path}}" alt="" srcset=""></div>
    <input  type="file" class="form-control-file" id="exampleInputEmail1" aria-describedby="emailHelp" name = "txtImage">
    <label  class="form-label">Ảnh chi tiết</label>
    <input  type="file" class="form-control-file" multiple id="exampleInputEmail1" aria-describedby="emailHelp" name = "txtImageDetail[]">
 <div class="col-md-12 container_image_detail">
    <div class="row">
        @foreach($product->productimage as $item)
        <div class="col-md-3">
            <img class="image_detail" src="{{$item->image_path}}" alt="" srcset="">
        </div>
        @endforeach
    </div>
 </div>
    <div class="mb-3 mt-3">
      <label  class="form-label">Chọn danh mục</label>
      <select  class="form-select select2_init" name="txtCategory_id">
        <option value="">Chọn damh mục </option>
       {!!$htmlOption!!}
      </select>
    </div>
    <div class="mb-3 mt-3">
    <label  class="form-label">Nhập Tag cho sản phẩm</label>
    <select name="txtTag[]" class="form-control tags_select_choose" multiple="multiple">
 @foreach($product->tags as $item)
    <option value="{{$item->name}}" selected class="tag"> {{$item->name}}</option>
    @endforeach
</select>
</div>
    <div class="form-group">
    <label for="exampleFormControlTextarea1">Nội dung</label>
    <textarea class="form-control tinymce_editor_init"  rows="3" name="txtContent">{{$product->content}}</textarea>
  </div>
  </div>


  <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
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
@section('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
  $(function(){
    $(".tags_select_choose").select2({
    tags: true,
    tokenSeparators: [',']
})
$(".select2_init").select2({
  placeholder: "Chọn danh mục",
    allowClear: true
})
  });

  let editor_config = {
    path_absolute : "/",
    selector: 'textarea.tinymce_editor_init',
    relative_urls: false,
    plugins: [
      "advlist autolink lists link image charmap print preview hr anchor pagebreak",
      "searchreplace wordcount visualblocks visualchars code fullscreen",
      "insertdatetime media nonbreaking save table directionality",
      "emoticons template paste textpattern"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
    file_picker_callback : function(callback, value, meta) {
      let x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
      let y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

      var cmsURL = editor_config.path_absolute + 'filemanager?editor=' + meta.fieldname;
      if (meta.filetype == 'image') {
        cmsURL = cmsURL + "&type=Images";
      } else {
        cmsURL = cmsURL + "&type=Files";
      }

      tinyMCE.activeEditor.windowManager.openUrl({
        url : cmsURL,
        title : 'Filemanager',
        width : x * 0.8,
        height : y * 0.8,
        resizable : "yes",
        close_previous : "no",
        onMessage: (api, message) => {
          callback(message.content);
        }
      });
    }
  };

  tinymce.init(editor_config);
</script>

@endsection