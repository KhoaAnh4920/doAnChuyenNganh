@extends('backend.layouts.master')
@section('title','Sửa danh mục bài viết')
@section('content')
<section class="wrapper">
    <div class="form-w3layouts">
        <!-- page start-->
        <!-- page start-->
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        Sửa danh mục bài viết
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
                            <form role="form">
                            <div class="form-group">
                                    <label for="exampleInputPassword1">ID</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1"
                                        placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Tên danh mục</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1"
                                        placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả</label>
                                    <textarea class="form-control" rows="4"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Slug </label>
                                    <input type="text" class="form-control" id="exampleInputPassword1"
                                        placeholder="Password">
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