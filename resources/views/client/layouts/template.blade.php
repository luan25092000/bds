<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css" />
    <link rel="stylesheet" type="text/css" href="{{ asset("client/assets/css/public8e5e.css?v=15") }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset("client/assets/css/style80ba.css?v=23") }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset("client/assets/css/style.css") }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset("client/assets/css/categorys7b30.css") }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset("client/assets/scripts/source/jquery.fancybox8cbb.css?v=2.1.5") }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset("client/assets/scripts/source/helpers/jquery.fancybox-buttons3447.css?v=1.0.5") }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset("client/assets/scripts/back-to-top/css/style5e1f.css?v=2") }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset("client/assets/scripts/diapo-v101/diapo.css") }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset("client/assets/scripts/FlexSlider2/css/flexslider.css") }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset("client/assets/scripts/malihu-custom-scrollbar/jquery.mCustomScrollbar.css") }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset("client/assets/scripts/fontawesome/css/all.css") }}" />
    <title>@yield('title')</title>
</head>

<body>
    <div class="overAll">
        <header>
            <div class="top-content">
                <div class="container overHide clearfm">
                    <div id="show-menu">Menu</div>
                    <div class="left hotline"><a href="/">Công ty bất động sản Anh Duy</a></div>
                    <div class="right">
                        <div class="menu-top">
                            <a href="{{ route('auth.show.login') }}">Đăng nhập</a>
                            <a href="{{ route('auth.show.register') }}">Đăng ký</a>
                            <a href="{{ route('introduce') }}">Giới thiệu</a>
                            <a href="{{ route('project') }}">Dự án</a>
                            <a href="{{ route('wishlist') }}">Yêu thích<sup class="wishlist">0</sup></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content">
                <div class="container overHide clearfm">
                    <div class="overHide">
                        <h1 class="logo img">
                            <a href="{{ route('home') }}">
                                <img src="{{ asset("client/assets/images/logo.png") }}" alt="công ty bất động sản Anh Duy" />
                            </a>
                        </h1>
                        <div class="slogannone">Công ty bất động sản Anh Duy</div>
                    </div>
                    <nav>
                        <ul class="menuMain">
                            <li class="home"><a href="{{ route('home') }}">Trang chủ</a></li>
                            @foreach ($categories as $category)
                                <li><a href=''>{{ $category->name }}</a></li>
                            @endforeach
                            <li><a href="{{ route('article') }}">Tin tức</a></li>
                        </ul>
                    </nav>
                    <div class="close"></div>
                </div>
            </div>
            <div id="slideshow">
                <div class="pix_diapo">
                    @php
                        $count = 1;
                    @endphp
                    @for ($i = 1; $i <= 3; $i++)
                        <div data-thumb="{{ asset('client/assets/images/banner-') . $count . '.jpg' }}">
                            <img src="{{ asset('client/assets/images/banner-') . $count . '.jpg' }}"/>
                        </div>
                        @php
                            $count++;
                        @endphp
                    @endfor
                </div>
            </div>
        </header>
        @yield('content')
        <footer>
            <div class="content">
                <div class="container overHide clearfm">
                    <div class="infocompay-footer left">
                        <h1>Công ty bất động sản Anh Duy</h1>
                        <p><i class="fas fa-map-marker-alt"></i> Địa chỉ: </p>
                        <p><i class="fas fa-phone-volume"></i> Điện thoại: <a href="tel:0123456789">0123456789</a></p>
                        <p style="display:block;"><i class="fas fa-envelope"></i> Email: <a href="mailto:anhduy@gmail.com">anhduy@gmail.com</a></p>
                    </div>

                    <ul class="menu-footer right">
                        @foreach ($categories as $category)
                            <li><a href=''>{{ $category->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="foot">
                <div class="container overHide clearfm">
                    <div class="left">
                        <p>&copy; Bản quyền 2021 thuộc về công ty bất động sản Anh Duy.</p>
                    </div>
                </div>
            </div>
        </footer>

        <div class="icon_menu"></div>
        <a href="#0" class="cd-top" style="margin-right:3rem;"><i class="fab fa-angle-up" aria-hidden="true"></i></a>
        <div class="hotline-fixed clearfm">
            <div class="hotline-icon"><i class="fab fa-phone" aria-hidden="true"></i></div>
            <div class="hotline-number"><a href="tel:0123456789" class="sdt sdt1">
                Anh Duy: 0123456789</a>
                <div class="close"></div>
            </div>
        </div>
    </div>
    <div class="mzalo">
        <a href="http://zalo.me/0123456789" target="_blank"
            style="display:block;width:100%;height:100%;position:relative;">
            <img src="{{ asset("client/assets/images/mzalo.png") }}" style="position: absolute;left: 0;bottom: 0;width: 50px;height: 50px;" />
        </a>
    </div>
    <div class="mmap">
        <a href=""
            target="_blank" style="display:block;width:100%;height:100%;position:relative;">
            <img src="{{ asset("client/assets/images/icon-maps2.png") }}" style="position: absolute;left: 0;bottom: 0;width: 50px;" />
        </a>
    </div>
    <div class="yt">
        <a href="" target="_blank"
            style="display:block;width:100%;height:100%;position:relative;">
            <img src="{{ asset("client/assets/images/icon-youtube.png") }}" style="display:block; width: 50px;" />
        </a>
    </div>

    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
    <!--[if !IE]><!-->
    <script type="text/javascript" src="{{ asset("client/assets/scripts/diapo-v101/scripts/jquery.mobile-1.0rc2.customized.min.js") }}"></script>
    <!--<![endif]-->
    <script type="text/javascript" src="{{ asset("client/assets/scripts/diapo-v101/scripts/jquery.easing.1.3.js") }}"></script>
    <script type="text/javascript" src="{{ asset("client/assets/scripts/diapo-v101/scripts/jquery.hoverIntent.minified.js") }}"></script>
    <script type="text/javascript" src="{{ asset("client/assets/scripts/diapo-v101/scripts/diapo.js") }}"></script>
    <script type="text/javascript" src="{{ asset("client/assets/scripts/source/jquery.fancybox.pack8cbb.js?v=2.1.5") }}"></script>
    <script type="text/javascript" src="{{ asset("client/assets/scripts/source/helpers/jquery.fancybox-buttons3447.js?v=1.0.5") }}"></script>
    <script type="text/javascript" src="{{ asset("client/assets/scripts/malihu-custom-scrollbar/jquery.mCustomScrollbar.concat.min.js") }}"></script>
    <script type="text/javascript" src="{{ asset("client/assets/scripts/back-to-top/js/main.js") }}"></script>
    <script type="text/javascript" src="{{ asset("client/assets/scripts/ScrollToFixed/jquery-scrolltofixed-min.js") }}"></script>
    <script type="text/javascript" src="{{ asset("client/assets/scripts/ScrollToFixed/jquery.sticky-kit.min.js") }}"></script>
    <script type="text/javascript" src="{{ asset("client/assets/scripts/js/script.js") }}"></script>
</body>

</html>