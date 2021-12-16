@extends('backend.layouts.master')
@section('title','Liệt kê chi tiết đơn hàng')
@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Thông tin khách hàng</h6>
            </div>
            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                        <tr>
                            <th>Tên khách hàng</th>
                            <th>Địa chỉ</th>
                            <th>Số điện thoại</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($order_by_id as $key => $cus)
                        <tr>                          
                            <td><span class="text-ellipsis">{{$cus->tenNguoiNhanHang}}</span></td>
                            <td><span class="text-ellipsis">{{$cus->diaChiGiaoHang}}</span></td>
                            <td><span class="text-ellipsis">{{$cus->soDienThoai}}</span></td>
                            <td>
                                <a href="{{URL::to('/sua-khach-hang.html')}}" class="btn btn-info" role="button"><i
                                        class="fa fa-edit text-success text-active" style="color:#ffffff"></i> Edit</a>
                                <a href="#" onclick="return confirm('Bạn có muốn xóa không ?')"
                                    class="btn btn-danger" role="button"><i class="fa fa-trash text-danger text"
                                        style="color:#ffffff"></i> Delete</a>
                            </td>
                        </tr>
                    @endforeach


                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Thông tin chi tiết đơn hàng</h6>
            </div>
            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                        <tr>
                            <th>STT</th>
                            <th>Tên sản phẩm</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Tổng tiền</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php $i = 0; $tongTien = 0 @endphp
                    @foreach($order_detail as $key => $order)
                        @php $i++ @endphp
                        <tr>
                            </td>
                            <td>{{$i}}</td>
                            <td><span class="text-ellipsis">{{$order->tensanpham}}</span></td>
                            <td><span class="text-ellipsis">{{$order->giaSanPham}}</span></td>
                            <td>
                                <span class="text-ellipsis"><input type="number" class="order_qty_{{$order->maSanPham}}" name ="order_qty" style="width:40px" min="1" max="100" value="{{$order->soLuong}}"></span>
                                
                                <input type="hidden" name="order_id" class="order_code" value="{{$order->maDonHang}}">
                                <input type="hidden" name="order_product_id" class="order_product_id" value="{{$order->maSanPham}}">
                            </td>
                            <td><span class="text-ellipsis">
                                @php 
                                    $gia = $order->giaSanPham;
                                    $sl = $order->soLuong;
                                    $sum = $gia * $sl;
                                    $tongTien += $sum;
                                    echo number_format($sum);
                                @endphp
                            </span> VNĐ</td>
                            <td>
                                <a class="btn btn-info update_quantity_order"
                                data-product_id="{{$order->maSanPham}}" name="update_quantity_order" role="button"><i class="fa fa-edit text-success text-active"
                                        style="color:#ffffff"></i> Update</a>
                                <a href="#" onclick="return confirm('Bạn có muốn xóa không')" class="btn btn-danger"
                                    role="button"><i class="fa fa-trash text-danger text" style="color:#ffffff"></i>
                                    Delete</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td>Tổng cộng: </td>
                            <td>@php echo number_format($tongTien) @endphp VNĐ</td>
                        </tr>

                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection