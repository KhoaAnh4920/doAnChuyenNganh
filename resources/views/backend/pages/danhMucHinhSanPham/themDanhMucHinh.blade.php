@extends('backend.layouts.master')
@section('title','Thêm danh mục hình')
@section('content')
<section class="wrapper">
    <div class="form-w3layouts">
        <!-- page start-->
        <!-- page start-->
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        Thêm danh mục hình
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
                            <form role="form">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">ID sản phẩm</label>
                                    <input type="password" class="form-control" id="exampleInputPassword1"
                                        placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Hình ảnh (tối đa 4 ảnh)</label>
                                    <input type="file" class="form-control" id="exampleInputPassword1"
                                        >
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