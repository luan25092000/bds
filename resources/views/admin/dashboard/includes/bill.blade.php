<!-- /.col-lg-12 -->
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
    <thead>
        <tr>
            <th>#</th>
            <th>Khách hàng</th>
            <th>Số điện thoại</th>
            <th>Sản phẩm</th>
            <th>Tiền cần phải trả (thuê hằng tháng + điện + nước)</th>
            <th>Tháng</th>
            <th>Trạng thái</th>
            <th>Thời gian cập nhật</th>
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
                <td>{{ \App\Models\Order::onlyTrashed()->where('email',\App\Models\User::find($bill->user_id)->email)->first()->phone }}</td>
                <td>{{ \App\Models\Product::find(\App\Models\Order::onlyTrashed()->find(\App\Models\Bill::find($bill->id)->order_id)->product_id)->name }}</td>
                <td>{{ number_format(\App\Models\Product::find(\App\Models\Order::onlyTrashed()->find(\App\Models\Bill::find($bill->id)->order_id)->product_id)->room_price + \App\Models\Product::find(\App\Models\Order::onlyTrashed()->find(\App\Models\Bill::find($bill->id)->order_id)->product_id)->electricity_price + \App\Models\Product::find(\App\Models\Order::onlyTrashed()->find(\App\Models\Bill::find($bill->id)->order_id)->product_id)->water_price,-3,',',',') }}₫</td>
                <td>{{ date('m', strtotime($bill->created_at)) }}</td>
                <td>
                    @if ($bill->status == 0)
                        Chưa thanh toán
                    @else
                        Đã thanh toán
                    @endif
                </td>
                <td>{{ date('d/m/Y H:i:s', strtotime($bill->updated_at)) }}</td>
            </tr>
            @php
                $count++;
            @endphp
        @endforeach
    </tbody>
</table>                   