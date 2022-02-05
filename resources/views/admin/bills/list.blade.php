@extends('admin.layouts.index')


@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Hóa đơn
                    <small>Danh sách</small>
                </h1>
                @if(Session::has('invalid'))
                    <div class="alert alert-danger alert-dismissible">
                         <a class="close" data-dismiss="alert" aria-label="close">&times;</a>
                         {{Session::get('invalid')}}
                    </div>
               @endif
               @if(Session::has('success'))
                    <div class="alert alert-success alert-dismissible">
                         <a class="close" data-dismiss="alert" aria-label="close">&times;</a>
                         {{Session::get('success')}}
                    </div>
               @endif
            </div>
            <!-- /.col-lg-12 -->
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Khách hàng</th>
                        <th>Số điện thoại</th>
                        <th>Sản phẩm</th>
                        <th>Tiền thuê</th>
                        <th>Tiền điện + nước</th>
                        <th>Tháng</th>
                        <th>Trạng thái</th>
                        <th>Thời gian cập nhật</th>
                        <th>Chức năng</th>
                    </tr>
                </thead>
                <tbody align="center">
                    @php
                        $count = 1;
                    @endphp
                    @foreach ($bills as $bill)
                        <tr>
                            <td>{{ $count }}</td>
                            <td>{{ \App\Models\User::find($bill->user_id)->name }}</td>
                            <td>{{ \App\Models\Order::where('email',\App\Models\User::find($bill->user_id)->email)->first()->phone }}</td>
                            <td>{{ \App\Models\Product::find(\App\Models\Order::find(\App\Models\Bill::find($bill->id)->order_id)->product_id)->name }}</td>
                            <td>{{ number_format(\App\Models\Product::find(\App\Models\Order::find(\App\Models\Bill::find($bill->id)->order_id)->product_id)->room_price,-3,',',',') }}₫</td>
                            <td>{{ number_format(\App\Models\Product::find(\App\Models\Order::find(\App\Models\Bill::find($bill->id)->order_id)->product_id)->electricity_price + \App\Models\Product::find(\App\Models\Order::find(\App\Models\Bill::find($bill->id)->order_id)->product_id)->water_price,-3,',',',') }}₫</td>
                            <td>{{ date('m', strtotime($bill->created_at)) }}</td>
                            <td>
                                @if ($bill->status == 0)
                                    Chưa thanh toán
                                @else
                                    Đã thanh toán
                                @endif
                            </td>
                            <td>{{ date('d/m/Y H:i:s', strtotime($bill->updated_at)) }}</td>
                            <td>
                                
                            </td>
                        </tr>
                        @php
                            $count++;
                        @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
@endsection