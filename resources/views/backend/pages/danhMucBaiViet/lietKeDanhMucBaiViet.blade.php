@extends('backend.layouts.master')
@section('title','Liệt kê danh mục bài viết')
@section('content')
<section class="wrapper">
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Liệt kê danh mục bài viết
            </div>
            <div class="row w3-res-tb">
                <div class="col-sm-5 m-b-xs">
                    <select class="input-sm form-control w-sm inline v-middle">
                        <option value="0">Bulk action</option>
                        <option value="1">Delete selected</option>
                        <option value="2">Bulk edit</option>
                        <option value="3">Export</option>
                    </select>
                    <button class="btn btn-sm btn-default">Apply</button>
                </div>
                <div class="col-sm-4">
                </div>
                <div class="col-sm-3">
                    <div class="input-group">
                        <input type="text" class="input-sm form-control" placeholder="Search">
                        <span class="input-group-btn">
                            <button class="btn btn-sm btn-default" type="button">Go!</button>
                        </span>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped b-t b-light">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên danh mục</th>
                            <th>Mô tả</th>
                            <th>Slug</th>
                            <th>Action</th>
                            <th style="width:30px;"></th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            </td>
                            <td>AAAAA</td>
                            <td>8c</td>
                            <td>Lorem</td>
                            <td>Lorem</td>
                            <td>
                            <a href="{{URL::TO('/sua-danh-muc-bai-viet.html')}}" class="btn btn-info" role="button"><i class="fa fa-edit text-success text-active" style="color:#ffffff"></i> Edit</a>
                            <a href="#"  onclick="return confirm('Bạn có muốn xóa không')" class="btn btn-danger" role="button"><i class="fa fa-trash text-danger text" style="color:#ffffff"></i> Delete</a>
                            </td>
                        </tr>
                        <tr>
                            </td>
                            <td>BBBB</td>
                            <td>8c</td>
                            <td>Lorem</td>
                            <td>Lorem</td>
                            <td>
                            <a href="{{URL::TO('/sua-danh-muc-bai-viet.html')}}" class="btn btn-info" role="button"><i class="fa fa-edit text-success text-active" style="color:#ffffff"></i> Edit</a>
                            <a href="#"  onclick="return confirm('Bạn có muốn xóa không')" class="btn btn-danger" role="button"><i class="fa fa-trash text-danger text" style="color:#ffffff"></i> Delete</a>
                            </td>
                        </tr>
                        <tr>
                            </td>
                            <td>CCCC</td>
                            <td>8c</td>
                            <td>Lorem</td>
                            <td>Lorem</td>
                            <td>
                            <a href="{{URL::TO('/sua-danh-muc-bai-viet.html')}}" class="btn btn-info" role="button"><i class="fa fa-edit text-success text-active" style="color:#ffffff"></i> Edit</a>
                            <a href="#"  onclick="return confirm('Bạn có muốn xóa không')" class="btn btn-danger" role="button"><i class="fa fa-trash text-danger text" style="color:#ffffff"></i> Delete</a>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection