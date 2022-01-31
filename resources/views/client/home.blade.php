@extends('client.layouts.template')

@section('title', 'Trang chủ')

@section('content')
<article>
    @foreach ($categories as $category)
        <div class="boxes menu-default">
            <div class="container">
                <div class="title-cat">
                    <span class="clearfm">
                        <a href="">
                            {{ $category->name }}
                        </a>
                    </span>
                </div>
                <div class="SlideLeftOject">
                    <div class="contain overHide clearfm">
                        <ul class="overHide feature-home">
                            @php
                                $products = \App\Models\Product::where('category_id', $category->id)->where('status',1)->take(8)->orderBy('view', 'DESC')->orderBy('id', 'DESC')->get();
                            @endphp
                            @foreach ($products as $product)
                                <li class="item">
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
                    </div>
                    <div class="next"></div>
                    <div class="prev"></div>
                    <a class="all"
                    href="{{ route('product.category', ['id' => $category->id]) }}">
                        Xem tất cả
                    </a>
                </div>
            </div>
        </div>
    @endforeach
    <section class="mtop40">
        <div class="container">
            <div class="boxes">
                <div class="title-cat clearfm">
                    <span id="ctl00_ContentPlaceHolder1_lbDesignArticle">Tin tức</span>
                    <a id="ctl00_ContentPlaceHolder1_hplDesignArticle" class="link"
                        href="{{ route('article') }}">
                        Xem tất cả
                    </a>
                </div>
                <div class="contain clearfm">
                    @include('client.includes.article-left', compact('leftArticle'))
                    @include('client.includes.article-right', compact('rightArticle'))
                </div>
            </div>
        </div>
    </section>
</article>

<div class="videohome">
    <div class="container overHide clearfm pdingm">
        <div class="td-product">
            <hgroup class="title-default">
                <h2>Video dự án</h2>
                <h5>Các Video dự án được công ty bất động sản Anh Duy đầu tư chuyên nghiệp và tỉ mỉ để Quý khách hàng có cái nhìn tổng quan hơn về từng dự án.</h5>
            </hgroup>
        </div>
        <ul class="ulvp">
            <li class="livp">
                <div class="video">
                    <a data-fancybox="youtube" class="fancybox fancybox.iframe" href="https://www.youtube.com/embed/aVK_VY3GnI0">
                        <iframe src="https://www.youtube.com/embed/aVK_VY3GnI0" 
                            frameborder="0" allowfullscreen></iframe>
                    </a>
                </div>
                <h4>
                    <span class="line2">Khám Phá Căn Hộ "ĐEN VÂU" Trị Giá 3 TỶ rộng 100m2 tại Dự án Green Park CT15 Việt Hưng - NhaF [4K]</span>
                </h4>
            </li>
            <li class="livp">
                <div class="video">
                    <a data-fancybox="youtube" class="fancybox fancybox.iframe" href="https://www.youtube.com/embed/BkssKETfnPM">
                        <iframe src="https://www.youtube.com/embed/BkssKETfnPM" 
                            frameborder="0" allowfullscreen></iframe>
                    </a>
                </div>
                <h4>
                    <span class="line2">TNA147 | Mẫu nhà 2 tầng đẹp | nhà 5.5x18m | gara ô tô | Small House Design Idea</span>
                </h4>
            </li>
            <li class="livp">
                <div class="video">
                    <a data-fancybox="youtube" class="fancybox fancybox.iframe" href="https://www.youtube.com/embed/eAlrkO2glsQ">
                        <iframe src="https://www.youtube.com/embed/eAlrkO2glsQ" 
                            frameborder="0" allowfullscreen></iframe>
                    </a>
                </div>
                <h4>
                    <span class="line2">[ Video 3D ] Mẫu Nhà Ống 20M Cực đẹp 2 tầng - Giếng trời</span>
                </h4>
            </li>
        </ul>
    </div>
</div>

<div class="tuvan-default">
    <div class="container overHide clearfm pdingm">
        <hgroup class="title-tuvan">
            <h2>Hãy gọi ngay chúng tôi</h2>
            <h5>Để được tư vấn miễn phí</h5>
        </hgroup>
        <ul class="ultv">
            <li>
                <a id="ctl00_ContentPlaceHolder1_hplHotline" href="tel:0355969717">0355969717</a>
            </li>
            <li>
                <a id="ctl00_ContentPlaceHolder1_hplLienhe"
                    href="mailto:anhduy@gmail.com">anhduy@gmail.com</a>
            </li>
        </ul>
    </div>
</div>
<div class="about-default">
    <div class="container overHide clearfm pdingm">
        <div class="text-about">
            <hgroup class="title-about">
                <h2>Về chúng tôi</h2>
                <h5>Công ty bất động sản Anh Duy</h5>
            </hgroup>
            <div class="ttgt">
                Ngay từ ngày đầu thành lập, công ty bất động sản Anh Duy đã thực hiện các dịch vụ thiết kế và xây dựng trên nhiều địa phương khắp cả nước. Trên suốt chặng đường qua,công ty bất động sản Anh Duy đã luôn tạo được dấu ấn tốt cho các khách hàng, không chỉ về mặt chuyên môn, mà còn gắn kết với khách hàng trong từng dự án, đảm bảo sự hài lòng và đạt được sự tín nhiệm lâu dài.
            </div>
            <div class="linkgt">
                <a href="{{ route('introduce') }}">Giới thiệu <i class="fal fa-angle-right"></i></a>
            </div>
        </div>
        <div class="picture-about">
            <img class="imggt imggt1" src="{{ asset("client/assets/images/imggt1.png") }}" />
            <img class="imggt imggt2" src="{{ asset("client/assets/images/imggt2.png") }}" />
        </div>
    </div>
</div>
@endsection