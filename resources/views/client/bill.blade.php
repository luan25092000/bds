@extends('client.layouts.template')

@section('title', 'Hóa đơn')

@section('content')
    <style>
        #wishlist {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
            margin-top:1rem;
            text-align: center;
        }

        #wishlist td,
        #wishlist th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #wishlist tr {
            background-color: #f2f2f2;
        }

        #wishlist th {
            padding-top: 12px;
            padding-bottom: 12px;
            background-color: #04AA6D;
            color: white;
        }

    </style>
    <article id="Wrapper" class="Section">
        <div class="container">
            <section class="col-section">
                <div class="boxes">
                    <div class="title-cat">
                        <span>
                            Hóa đơn
                        </span>
                    </div>
                    @if ($bills->count() > 0)
                        <table id="wishlist">
                            <tr>
                                <th>Sản phẩm</th>
                                <th>Tiền cần phải trả (thuê hằng tháng + điện + nước)</th>
                                <th>Tháng</th>
                                <th>Trạng thái</th>
                                <th>Thời gian cập nhật</th>
                            </tr>
                            @foreach ($bills as $bill)
                                <tr>
                                    <td>{{ \App\Models\Product::find(\App\Models\Order::withTrashed()->find(\App\Models\Bill::find($bill->id)->order_id)->product_id)->name }}</td>
                                    <td>{{ number_format(\App\Models\Product::find(\App\Models\Order::withTrashed()->find(\App\Models\Bill::find($bill->id)->order_id)->product_id)->room_price + \App\Models\Product::find(\App\Models\Order::withTrashed()->find(\App\Models\Bill::find($bill->id)->order_id)->product_id)->electricity_price + \App\Models\Product::find(\App\Models\Order::withTrashed()->find(\App\Models\Bill::find($bill->id)->order_id)->product_id)->water_price,-3,',',',') }}₫</td>
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
                            @endforeach
                        </table>
                    @else
                        <div style="color:white; font-size:1.2rem;">Hiện tại chưa có hóa đơn nào</div>
                    @endif
                </div>
            </section>
            <aside class="col-side fixed">
                @include('client.includes.project',['projects' => $projects])
                @include('client.includes.article',['articles' => $articles])
            </aside>
        </div>
    </article>
@endsection
