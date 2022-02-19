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
                                    Chưa xem
                                @elseif ($order->status == 2)
                                    Đã xem
                                @else
                                    Đã chốt
                                @endif
                            </td>
                            <td>{{ date('d/m/Y H:i:s', strtotime($order->created_at)) }}</td>
                            <td>
                                @if ($order->status != 1)
                                    <div class="dropdown">
                                        <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-toggle="dropdown">Hành động
                                        <span class="caret"></span></button>
                                        <ul class="dropdown-menu" style="min-width:80px !important;">
                                            <li><a href="{{ route('order.delete',['id' => $order->id]) }}" onclick="return confirm('Bạn muốn xóa hợp đồng này ?')">Xóa</a></li>
                                            <li><a href="{{ route('order.not.see',['id' => $order->id]) }}">Chưa xem</a></li>
                                            <li><a href="{{ route('order.see',['id' => $order->id]) }}">Đã xem</a></li>
                                            <li><a href="{{ route('order.done',['id' => $order->id]) }}" onclick="return confirm('Bạn muốn chốt hợp đồng này ?')">Chốt</a></li>
                                        </ul>
                                    </div>
                                @elseif ($order->status == 1)
                                    @php
                                        $existBill = \App\Models\Bill::where('order_id', $order->id)->orderBy('id','desc')->first();
                                        $bill = \App\Models\Bill::where([['order_id', $order->id], ['status', 1]])->first();
                                    @endphp
                                    {{-- Check xem hóa đơn tháng trước đã thanh toán hay chưa --}}
                                    {{-- @if (date('n') != date('n', strtotime(@$bill->created_at))) --}}
                                        {{-- Check hóa đơn gần nhất có thời gian tạo mới khác với tháng hiện tại --}}
                                        @if (date('n',strtotime(@$existBill->created_at)) != date('n'))
                                            @if (date('j') > date('j', strtotime($order->created_at)))
                                                <a href="{{ route('order.send.bill',['id' => $order->id]) }}" style="margin:0 1rem;"><i class="fa fa-bell" aria-hidden="true"></i></a>
                                            @else
                                                <a href="{{ route('order.send.bill',['id' => $order->id]) }}" style="margin:0 1rem;" onclick="return confirm('Hôm nay chưa phải là cuối tháng, bạn có chắc chắn muốn gửi hóa đơn về cho khách hàng ?')"><i class="fa fa-bell" aria-hidden="true"></i></a>
                                            @endif
                                        @else
                                            <span class="text-danger">Hóa đơn đã gửi về cho khách hàng, vui lòng liên hệ để được thanh toán</span>
                                        @endif
                                    {{-- @else  
                                        <span class="text-danger">Nút thông báo sẽ được hiện vào tháng tiếp theo</span>
                                    @endif --}}
                                    <div class="dropdown">
                                        <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-toggle="dropdown">Hành động
                                        <span class="caret"></span></button>
                                        <ul class="dropdown-menu" style="min-width:80px !important;">
                                            <li><a href="{{ route('order.delete',['id' => $order->id]) }}" onclick="return confirm('Bạn muốn xóa hợp đồng này ?')">Xóa</a></li>
                                        </ul>
                                    </div>
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