@extends('backend.layouts.master')
@section('title','Liệt kê bài viết')
@section('content')
<section class="wrapper">
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Liệt kê bài viết
            </div>
            <div class="table-responsive">
                <table class="table table-striped b-t b-light">
                    <thead>
                        <tr>
                            </th>
                            <th>ID</th>
                            <th>Tiêu đề bài viết</th>
                            <th>Hình ảnh</th>
                            <th>Danh mục</th>
                            <th>Mô tả</th>
                            <th>Nội dung</th>
                            <th>Action</th>
                            <th style="width:30px;"></th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            </td>
                            <td>01</td>
                            <td>8c</td>
                            <td>Lorem</td>
                            <td>Lorem</td>
                            <td>Lorem</td>
                            <td>Lorem</td>
                            <td>
                            <a href="{{URL::TO('/sua-bai-viet.html')}}" class="btn btn-info" role="button"><i class="fa fa-edit text-success text-active" style="color:#ffffff"></i> Edit</a>
                            <a href="#"  onclick="return confirm('Bạn có muốn xóa không')" class="btn btn-danger" role="button"><i class="fa fa-trash text-danger text" style="color:#ffffff"></i> Delete</a>
                            </td>
                        </tr>
                        <tr>
                            
                        <td>02</td>
                            <td>8c</td>
                            <td>Lorem</td>
                            <td>Lorem</td>
                            <td>Lorem</td>
                            <td>Lorem</td>
                            <td>
                            <a href="{{URL::TO('/sua-bai-viet.html')}}" class="btn btn-info" role="button"><i class="fa fa-edit text-success text-active" style="color:#ffffff"></i> Edit</a>
                            <a href="#"  onclick="return confirm('Bạn có muốn xóa không')" class="btn btn-danger" role="button"><i class="fa fa-trash text-danger text" style="color:#ffffff"></i> Delete</a>
                            </td>
                        </tr>
                        <tr>
                            
                            </td>
                            <td>03</td>
                            <td>8c</td>
                            <td>Lorem</td>
                            <td>Lorem</td>
                            <td>Lorem</td>
                            <td>Lorem</td>
                            <td>
                            <a href="{{URL::TO('/sua-bai-viet.html')}}" class="btn btn-info" role="button"><i class="fa fa-edit text-success text-active" style="color:#ffffff"></i> Edit</a>
                            <a href="#"  onclick="return confirm('Bạn có muốn xóa không')" class="btn btn-danger" role="button"><i class="fa fa-trash text-danger text" style="color:#ffffff"></i> Delete</a>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection