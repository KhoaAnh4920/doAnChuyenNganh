@extends('backend.layouts.master')
@section('title','Liệt kê danh mục hình')
@section('styles')
<style>
.btnClose{
    margin-right:20px;
}
hr{
    margin-top:0px;
}
.btnDeleteUser{
    text-decoration: none;
    color: #ffffff;
}
.btnDeleteUser:hover{
    color: #fafafa;
}
@media (max-width: 526px) {
     .card {
         width: unset
     }
 }

</style>
@endsection
@section('content')
<section class="wrapper">
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Liệt kê danh mục hình
            </div>
            <div class="row w3-res-tb">
                <form action="{{url('/insert-gallery/'.$pro_id)}}" method="POST" enctype="multipart/form-data">
                    {!! csrf_field() !!}
                    <div class="row">
                        <div class="col-md-3" align="right">

                        </div>
                        <div class="col-md-6">
                            <input type="file" class="form-control" id="file" name="file[]" accept="image/*" multiple>
                            <span id="error_gallery"></span>

                        </div>
                        <div class="col-md-3">
                            <input type="submit" name="upload" name="taianh" value="Tải ảnh" class="btn btn-success ">
                        </div>

                    </div>
                </form>
                <input type="hidden" value="{{$pro_id}}" name="pro_id" class="pro_id">
            </div>
            <div class="table-responsive" id="gallery_load">

                <!-- <table class="table table-striped b-t b-light">
                    <thead>
                        <tr>
                            <th>ID hình</th>
                            <th>ID sản phẩm</th>
                            <th>Hình ảnh</th>
                            <th>Hiển thị</th>
                            <th>Action</th>
                            <th style="width:30px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>                          
                            <td>AAAAA</td>
                            <td>8c</td>
                            <td>Lorem</td>
                            <td>Lorem</td>
                            <td>
                            <a href="{{URL::to('/sua-danh-muc-hinh.html')}}" class="btn btn-info" role="button"><i class="fa fa-edit text-success text-active" style="color:#ffffff"></i> Edit</a>
                            <a href="#"  onclick="return confirm('Bạn có muốn xóa không')" class="btn btn-danger" role="button"><i class="fa fa-trash text-danger text" style="color:#ffffff"></i> Delete</a>

                            </td>
                        </tr>
 
                    </tbody>
                </table> -->
            </div>
            @if(!empty(Session::get('error_code')) && Session::get('error_code') == 5)
            <script>
            $(function() {
                $('#ignismyModal').modal('show');
            });
            </script>
            @endif
            
        </div>
    </div>
</section>
@endsection