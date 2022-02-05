@extends('client.layouts.template')

@if (isset($project) && !is_null($project))
    @section('title', $project->name)

    @section('content')

    <article id="Wrapper" class="Section">
        <div class="container">
            <section class="col-section">
                <div class="boxes">
                    <div class="title-cat">
                        <span>
                            Dự án
                        </span>
                    </div>
                    <h1 class="title-article">{{ $project->name }}</h1>
                    <div class="info">
                        <span id="ctl00_ContentPlaceHolder1_lbDate" class="icon date">{{ date('d-m-Y',strtotime($project->created_at)) }}</span>
                        <span id="ctl00_ContentPlaceHolder1_lbCount" class="icon views">{{ $project->view }}</span>
                    </div>
                    <div class="detail">
                        Địa chỉ: {{ $project->address }}
                        <br><br>
                        Trạng thái:
                        @if ($project->status == 0)
                            <span style="color:#A49D99;background-color:#F2F2F2;padding:0.2rem;font-size:0.8rem;border-radius:0.2rem;">Đang cập nhật</span>
                        @else
                            <span style="color:#006D3C;background-color:#E7FFF4;padding:0.2rem;font-size:0.8rem;border-radius:0.2rem;">Đang mở bán</span>
                        @endif
                        <br><br>
                        @if (count($project["image"]) > 0)
                            <section class="slider" style="display: inline-block; width: 100%">
                                <div class="flexslider">
                                    <ul class="slides">
                                        @foreach ($project["image"] as $item)
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
                    @include('client.includes.relation-project', compact('relationProject'))
            </section>
            <aside class="col-side fixed">
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