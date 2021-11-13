@extends('backend.layouts.master')
@section('title','Sửa sản phẩm')
@section('content')
<section class="wrapper">
    <div class="form-w3layouts">
        <!-- page start-->
        <!-- page start-->
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        Sửa sản phẩm
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
                            <form role="form">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">ID</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                        placeholder="Enter email">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Tên sản phẩm</label>
                                    <input type="password" class="form-control" id="exampleInputPassword1"
                                        placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Hình ảnh</label>
                                    <input type="file" class="form-control" id="exampleInputPassword1"
                                        >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                        placeholder="Enter email">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Danh mục</label>
                                    <select class="form-control" name="statusDanhMuc">
                                        <option>Laptop</option>
                                        <option>Điện thoại</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Thương hiệu</label>
                                    <select class="form-control" name="statusDanhMuc">
                                        <option>Apple</option>
                                        <option>Hp</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả</label>
                                    <textarea class="form-control" rows="4"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Trạng thái</label>
                                    <select class="form-control" name="statusDanhMuc">
                                        <option>Ẩn</option>
                                        <option>Hiện</option>
                                    </select>
                                </div>
                                
                                <button type="submit" class="btn btn-info">Submit</button>
                            </form>
                        </div>

                    </div>
                </section>

            </div>
            
        </div>
        

        <!-- page end-->
    </div>
</section>

@endsection