@extends('client.layouts.template')

@section('title', 'Hợp đồng')

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
                            Hợp đồng
                        </span>
                    </div>
                    @if ($orders->count() > 0)
                        <table id="wishlist">
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
                                <td>{{ date('d/m/Y H:i:s', strtotime($order->updated_at)) }}</td>
                            </tr>
                            @php
                                $count++;
                            @endphp
                        @endforeach
                        </table>
                    @else
                        <a href="{{ route('home') }}" style="color:white; font-size:1.2rem;margin-top:1rem;">Tiếp tục xem sản phẩm</a>
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
