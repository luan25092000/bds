<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href='{{ asset("client/assets/images/logo.png") }}' type="image/png" />
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
    <script type="text/javascript" src="{{ asset("vendor/sweetalert/sweetalert.all.js") }}"></script>
    <script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js"></script>
    <title>@yield('title')</title>
</head>

<body>
    @include('sweetalert::alert')
    <div class="overAll">
        <header>
            <div class="top-content">
                <div class="container overHide clearfm">
                    <div id="show-menu">Menu</div>
                    <div class="left hotline"><a href="/">C??ng ty b???t ?????ng s???n Anh Duy</a></div>
                    <div class="right">
                        <div class="menu-top">
                            @if (!Auth::check())
                                <a href="{{ route('auth.show.login') }}">????ng nh???p</a>
                            @else
                                <a href="javascript:void(0)">Xin ch??o {{ Auth::user()->name }}</a>
                                <a href="{{ route('auth.logout') }}">????ng xu???t</a>
                                @can('customer')
                                    <a href="{{ route('bill') }}">H??a ????n<sup>{{ \App\Models\Bill::where('user_id', Auth::user()->id)->get()->count() }}</sup></a>
                                @endcan
                            @endif
                            <a href="{{ route('introduce') }}">Gi???i thi???u</a>
                            @if (Auth::check())
                                @can('customer')
                                    <a href="{{ route('contact') }}">Li??n h???</a>
                                @endcan
                            @else
                                <a href="{{ route('contact') }}">Li??n h???</a>
                            @endif
                            <a href="{{ route('project') }}">D??? ??n</a>
                            @can('staff')
                                <a href="{{ route('order') }}">H???p ?????ng</a>
                            @endcan
                            @canany(['manager', 'staff'])
                                @php
                                    $productFilter = [];
                                    $productIds = \App\Models\Wishlist::pluck('product_id');
                                    foreach ($productIds as $productId) {
                                        $product = \App\Models\Product::find($productId);
                                        if ($product->status != 1) {
                                            $productFilter[] = $productId;
                                        }
                                    }
                                @endphp
                                <a href="{{ route('wishlist') }}">Y??u th??ch<sup class="wishlist">{{ \App\Models\Wishlist::where('user_id', Auth::user()->id)->whereNotIn('product_id', $productFilter)->get()->count() }}</sup></a>
                            @endcanany
                        </div>
                    </div>
                </div>
            </div>
            <div class="content">
                <div class="container overHide clearfm">
                    <div class="overHide">
                        <h1 class="logo img">
                            <a href="{{ route('home') }}">
                                <img src="{{ asset("client/assets/images/logo.png") }}" alt="c??ng ty b???t ?????ng s???n Anh Duy" style="padding-top:0.25rem;"/>
                            </a>
                        </h1>
                        <div class="slogannone">C??ng ty b???t ?????ng s???n Anh Duy</div>
                    </div>
                    <nav>
                        <ul class="menuMain">
                            <li class="home"><a href="{{ route('home') }}">Trang ch???</a></li>
                            @foreach ($categories->slice(0,7) as $category)
                                <li><a href='{{ route('product.category', ['id' => $category->id]) }}'>{{ $category->name }}</a></li>
                            @endforeach
                            <li><a href="{{ route('article') }}">Tin t???c</a></li>
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
            <div class="form-container">
                <form method="POST" action="{{ route('post.search') }}">

                    @csrf

                    <div class="wrapper">
                        <p style="color:white;">T??m ki???m s???n ph???m</p>
                        <div class="search-container">
                            <select name="category" class="search input">
                                <option value="">T???t c??? danh m???c</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <select name="price" class="search input">
                                <option value="">T???t c??? m???c gi??</option>
                                <option value="0">0 - 3,000,000??</option>
                                <option value="1">3,100,000?? - 4,000,000??</option>
                                <option value="2">4,100,000?? - 4,500,000??</option>
                                <option value="3">4,600,000?? - 5,000,000??</option>
                                <option value="4">5,100,000?? - 8,000,000??</option>
                                <option value="5">Tr??n 8,000,000 ??</option>
                            </select>
                            <select name="area" class="search input">
                                <option value="">T???t c??? di???n t??ch</option>
                                <option value="0">??? 30 m??</option>
                                <option value="1">30 - 50 m??</option>
                                <option value="2">> 50 m??</option>
                            </select>
                            @php
                                $cities = \App\Models\City::all();
                            @endphp
                            <select name="city_id" id="city_id" class="search input">
                                <option value="">Ch???n th??nh ph???</option>"
                                @foreach ($cities as $city)
                                    <option value="{{ $city->matp }}">{{ $city->name }}</option>
                                @endforeach
                            </select>
                            <div id="district">
                                @include('client.includes.district')
                            </div>
                            <div id="ward">
                                @include('client.includes.ward')
                            </div>
                            <button type="submit" class="button">T??m ki???m</button>
                        </div>
                    </div>
                </form>
            </div>
        </header>
        @yield('content')
        <footer>
            <div class="content">
                <div class="container overHide clearfm">
                    <div class="infocompay-footer left">
                        <h1>C??ng ty b???t ?????ng s???n Anh Duy</h1>
                        <p><i class="fas fa-map-marker-alt"></i> ?????a ch???: H?? N???i</p>
                        <p><i class="fas fa-phone-volume"></i> ??i???n tho???i: <a href="tel:0355969717">0355969717</a></p>
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
                        <p>&copy; B???n quy???n 2021 thu???c v??? c??ng ty b???t ?????ng s???n Anh Duy.</p>
                    </div>
                </div>
            </div>
        </footer>

        <div class="icon_menu"></div>
        <a href="#0" class="cd-top" style="margin-right:3rem;"><i class="fab fa-angle-up" aria-hidden="true"></i></a>
        <div class="hotline-fixed clearfm">
            <div class="hotline-icon"><i class="fab fa-phone" aria-hidden="true"></i></div>
            <div class="hotline-number"><a href="tel:0355969717" class="sdt sdt1">
                Anh Duy: 0355969717</a>
                <div class="close"></div>
            </div>
        </div>
    </div>
    <div class="mzalo">
        <a href="http://zalo.me/0355969717" target="_blank"
            style="display:block;width:100%;height:100%;position:relative;">
            <img src="{{ asset("client/assets/images/mzalo.png") }}" style="position: absolute;left: 0;bottom: 0;width: 50px;height: 50px;" />
        </a>
    </div>
    <div class="mmap">
        <a href="https://goo.gl/maps/agJvzbEVCb66k41s8"
            target="_blank" style="display:block;width:100%;height:100%;position:relative;">
            <img src="{{ asset("client/assets/images/icon-maps2.png") }}" style="position: absolute;left: 0;bottom: 0;width: 50px;" />
        </a>
    </div>
    <div class="yt">
        <a href="https://youtu.be/m4YJT2su1aY" target="_blank"
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
    <script type="text/javascript" src="{{ asset("client/assets/scripts/js/add-wishlist.js") }}"></script>
    <script>
        // Handle choose city,district,ward
        $('#city_id').change(function(e){
            var city_id = $(this).val();
            $.ajax({
                url: "/ajax_district",
                type: 'GET',
                data: {
                    city_id:city_id
                },
                beforeSend: function(xhr) {
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                }
            }).done(function(res){
                if (res.status == 200) {
                    $('#district').html(res.data);
                }
            });
        });
        $('#district').on('change', '#district_id', function(e){
            var district_id = $(this).val();
            $.ajax({
                url: "/ajax_ward",
                type: 'GET',
                data: {
                    district_id:district_id
                },
                beforeSend: function(xhr) {
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                }
            }).done(function(res){
                if (res.status == 200) {
                    $('#ward').html(res.data);
                }
            });
        });
    </script>
</body>

</html>