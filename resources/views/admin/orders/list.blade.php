@extends('admin.layouts.index')


@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Hợp đồng
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
                        <th>Sản phẩm</th>
                        <th>Họ tên khách hàng</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                        <th>Nhân viên</th>
                        <th>Ghi chú</th>
                        <th>Trạng thái</th>
                        <th>Thời gian cập nhật</th>
                        <th>Chức năng</th>
                    </tr>
                </thead>
                <tbody align="center">
                    @php
                        $count = 1;
                    @endphp
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $count }}</td>
                            <td>{{ \App\Models\Product::find($order->product_id)->name }}</td>
                            <td>{{ $order->fullname }}</td>
                            <td>{{ $order->email }}</td> 
                            <td>{{ $order->phone }}</td>
                            <td>{{ \App\Models\User::find($order->staff_id)->name }}</td>
                            <td>{{ !is_null($order->description) ? $order->description : 'N/A' }}</td>
                            <td>
                                @if ($order->status == 0)
                                    Đã xem
                                @else
                                    Đã chốt
                                @endif
                            </td>
                            <td>{{ date('d/m/Y H:i:s', strtotime($order->updated_at)) }}</td>
                            <td>
                                @if ($order->status == 0)
                                    <a href="{{ route('order.delete',['id' => $order->id]) }}" onclick="return confirm('Bạn muốn xóa hợp đồng này ?')"><i class="fa fa-times" aria-hidden="true"></i></a>
                                    <a href="{{ route('order.done',['id' => $order->id]) }}" style="margin:0 1rem;" onclick="return confirm('Bạn muốn chốt hợp đồng này ?')"><i class="fa fa-check-circle" aria-hidden="true"></i></a>
                                @elseif ($order->status == 1)
                                    @php
                                        $existBill = \App\Models\Bill::where('order_id', $order->id)->first();
                                        $bill = \App\Models\Bill::where([['order_id', $order->id], ['status', 1]])->first();
                                    @endphp
                                    @if (date('n') != date('n', strtotime(@$bill->created_at)))
                                        @if (is_null($existBill))
                                            @if (date('t') == date('j'))
                                                <a href="{{ route('order.send.bill',['id' => $order->id]) }}" style="margin:0 1rem;"><i class="fa fa-bell" aria-hidden="true"></i></a>
                                            @else
                                                <a href="{{ route('order.send.bill',['id' => $order->id]) }}" style="margin:0 1rem;" onclick="return confirm('Hôm nay chưa phải là cuối tháng, bạn có chắc chắn muốn gửi hóa đơn về cho khách hàng ?')"><i class="fa fa-bell" aria-hidden="true"></i></a>
                                            @endif
                                        @else
                                            <span class="text-danger">Hóa đơn đã gửi về cho khách hàng, vui lòng liên hệ để được thanh toán</span>
                                        @endif
                                    @else  
                                        <span class="text-danger">Nút thông báo sẽ được hiện vào tháng tiếp theo</span>
                                    @endif
                                @endif
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