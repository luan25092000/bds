@extends('client.layouts.template')

@if (isset($article) && !is_null($article))
    @section('title', $article->title)

    @section('content')
    <article id="Wrapper" class="Section">
        <div class="container">
            <section class="col-section">
                <div class="boxes">
                    <div class="title-cat">
                        <span>
                            {{ $article->category_name }}
                        </span>
                    </div>
                    <h1 class="title-article">{{ $article->title }}</h1>
                    <div class="info">
                        <span id="ctl00_ContentPlaceHolder1_lbDate" class="icon date">{{ date('d-m-Y',strtotime($article->created_at)) }}</span>
                        <span id="ctl00_ContentPlaceHolder1_lbCount" class="icon views">{{ $article->view }}</span>
                    </div>
                    <div class="detail">
                        {!! $article->description !!}
                    </div>
                    @include('client.includes.relation-article', compact('relationArticle'))
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