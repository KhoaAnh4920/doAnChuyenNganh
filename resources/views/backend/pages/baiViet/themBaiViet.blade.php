@extends('backend.layouts.master')
@section('title','Thêm bài viết')
@section('content')
<section class="wrapper">
    <div class="form-w3layouts">
        <!-- page start-->
        <!-- page start-->
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        Thêm bài viết
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
                            <form role="form">
                            <div class="form-group">
                                <div>
                                    <label for="exampleInputPassword1">ID bài viết</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1"
                                        placeholder="Password">
                                </div>
                                <div>
                                    <label for="exampleInputPassword1">ID admin</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1"
                                        placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Tiêu đề</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1"
                                        placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Danh mục</label>
                                    <select class="form-control" name="statusDanhMuc">
                                        <option>Danh mục 1</option>
                                        <option>Danh mục 2</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả</label>
                                    <textarea class="form-control" rows="4"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nội dung</label>
                                    <textarea class="form-control" rows="4"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Hình ảnh</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1"
                                        placeholder="Password">
                                </div>
        

                                <button type="submit" class="btn btn-info">Submit</button>
                            </form>
                        </div>

                    </div>

            </div>
            
        </div>
        

        <!-- page end-->
    </div>
</section>
@endsection