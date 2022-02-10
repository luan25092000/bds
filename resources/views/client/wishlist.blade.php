@extends('client.layouts.template')

@section('title', 'Yêu thích')

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
                            Yêu thích
                        </span>
                    </div>
                    @if ($wishlists->count() > 0)
                        <table id="wishlist">
                            <tr>
                                <th>Ảnh</th>
                                <th>Danh mục</th>
                                <th>Tên sản phẩm</th>
                                <th>Chức năng</th>
                            </tr>
                            @foreach ($wishlists as $wishlist)
                                @php
                                    $product = \App\Models\Product::find($wishlist->product_id);
                                @endphp
                                @if ($product->status == 1)
                                    <tr>
                                        <td><a href="{{ asset($product->image->first()->image_src) }}" target="_blank"><img src="{{ asset($product->image->first()->image_src) }}" width=60px></a></td>
                                        <td>
                                            {{ \App\Models\Category::find($product->category_id)->name }}
                                        </td>
                                        <td>
                                            {{ $product->name }}
                                        </td>
                                        <td>
                                            @php
                                                $order = \App\Models\Order::where([['product_id', $wishlist->product_id], ['status', 1]])->first()
                                            @endphp
                                            @if (is_null($order))
                                                <a href="{{ route('wishlist.delete', ['id' => $wishlist->id]) }}" onclick="return confirm('Bạn có muốn xóa item này ?')"><i class="fa fa-trash" style="color:red;" aria-hidden="true"></i></a>
                                                <a href="{{ route('wishlist.contract', ['id' => $wishlist->id]) }}" style="margin-left:1rem;color:rgb(170, 170, 36);"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                            @else
                                                <span style="color:red;">Hiện hợp đồng này đã được chốt</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endif
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
