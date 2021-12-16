@extends('backend.layouts.master')
@section('title','Thêm Đơn Hàng')
@section('content')

<section class="wrapper">
    <div class="form-w3layouts">
        <!-- page start-->
        <!-- page start-->
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        Thêm đơn hàng
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
                            <form role="form">
                            <div class="form-group">
                                    <label for="exampleInputPassword1">ID đơn hàng</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1"
                                        placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Tên sản phẩm</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1"
                                        placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Tên khách hàng</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1"
                                        placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Địa chỉ</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1"
                                        placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Số điện thoại</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1"
                                        placeholder="Password">
                                </div>
 

                                <button type="submit" class="btn btn-info">Thêm</button>
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