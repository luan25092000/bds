@extends('client.layouts.template')

@if (isset($product) && !is_null($product))
    @section('title', $product->name)

    @section('content')

    <style>
        .wishlist-button {
            color: white;
            text-decoration: none;
            border-radius: 5px;
            float: right;
            padding: 0.5rem;
            font-size: 1.5rem;
            background-color:green;
        }
        
        .wishlist-button:hover {
            background-color: rgb(3, 94, 3);
        }

        .wishlist-button-disable {
            color: white;
            text-decoration: none;
            border-radius: 5px;
            float: right;
            padding: 0.5rem;
            font-size: 1.5rem;
            background-color:grey;
        }
    </style>

    <article id="Wrapper" class="Section">
        <div class="container">
            <section class="col-section">
                <div class="boxes">
                    <div class="title-cat">
                        <span>
                            {{ $product->category_name }}
                        </span>
                    </div>
                    <h1 class="title-article">{{ $product->name }}</h1>
                    <div class="info">
                        <span id="ctl00_ContentPlaceHolder1_lbDate" class="icon date">{{ date('d-m-Y',strtotime($product->created_at)) }}</span>
                        <span id="ctl00_ContentPlaceHolder1_lbCount" class="icon views">{{ $product->view }}</span>
                        @canany(['manager', 'staff'])
                            @if (!is_null($wishlists) && in_array($product->id, $wishlists))
                                <a class="wishlist-button-disable" href="javascript:void(0)">Đã thêm yêu thích</a> 
                            @else
                                <a class="wishlist-button" href="javascript:void(0)" onclick="addWishlist({{ $product->id }})">Thêm yêu thích</a> 
                            @endif
                        @endcanany
                    </div>
                    <div class="detail">
                        {!! $product->description !!}
                        <br>
                        @if (count($product["image"]) > 0)
                            <section class="slider" style="display: inline-block; width: 100%">
                                <div class="flexslider">
                                    <ul class="slides">
                                        @foreach ($product["image"] as $item)
                                            <li data-thumb="{{ asset($item['image_src']) }}">
                                                <img src="{{ asset($item['image_src']) }}"/>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </section>
                            <script type='text/javascript' src='{{ asset("/client/assets/scripts/FlexSlider2/js/jquery.flexslider.js") }}'></script>
                            <script type="text/javascript">
                                $(window).load(function () {
                                    $('.flexslider').flexslider({
                                        animation: "slide",
                                        controlNav: "thumbnails"
                                    });
                                });
                            </script>
                        @endif
                    </div>
                    @include('client.includes.relation-product', compact('relationProduct'))
            </section>
            <aside class="col-side fixed">
                @include('client.includes.product-detail',['product' => $product])
                @include('client.includes.project',['projects' => $projects])
                @include('client.includes.article',['articles' => $articles])
            </aside>
        </div>
    </article>
    @endsection
@else
    @section('title','')

    @section('content')
    <article id="Wrapper" class="Section">
        <div class="container">
            <section class="col-section">
                <div class="boxes">
                    <div class="title-cat">
                        <span>
                           Chi tiết
                        </span>
                    </div><br />
                    <div style="color:white; font-size:1.2rem;">Nội dung chúng tôi sẽ cập nhật sau</div>
            </section>
            <aside class="col-side fixed">
                @include('client.includes.project',['projects' => $projects])
                @include('client.includes.article',['articles' => $articles])
            </aside>
        </div>
    </article>
    @endsection
@endif