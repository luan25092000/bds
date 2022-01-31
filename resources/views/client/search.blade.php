@extends('client.layouts.template')

@section('title','Kết quả tìm kiếm')

@section('content')
<article id="Wrapper" class="Section">
    <div class="container">
        <section class="col-section">
            <div class="boxes">
                <div class="title-cat">
                    <span id="ctl00_ContentPlaceHolder1_lbTitleCat">Kết quả tìm kiếm</span>
                </div>
                <div class="contain border clearfm">
                    @if (count($products) > 0)
                        <ul class="overHide feature-home">
                            @foreach ($products as $product)
                                <li class="item item-category">
                                    <a
                                        href="{{ route('product.detail', ['id' => $product->id]) }}">
                                        <div class="content">
                                            <div class="postImg">
                                                <img src="{{ asset($product->image->first()->image_src) }}" alt="{{ $product->name }}" />
                                            </div>
                                            <span class="views">{{ $product->view }}</span>
                                        </div>
                                    </a>
                                    <h4>
                                        <a
                                            href="{{ route('product.detail', ['id' => $product->id]) }}">
                                            <span>{{ $product->name }}</span>
                                        </a>
                                    </h4>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <div style="color:white; font-size:1.2rem;">Không có kết quả tìm kiếm nào</div>
                    @endif
                    {{ $products->links() }}
                </div>
            </div>
        </section>
        <aside class="col-side fixed">
            @include('client.includes.project',['projects' => $projects])
            @include('client.includes.article',['articles' => $articles])
        </aside>
    </div>
</article>
@endsection