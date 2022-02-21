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
            </tr>
            @php
                $count++;
            @endphp
        @endforeach
    </tbody>
</table>