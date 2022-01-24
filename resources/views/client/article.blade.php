@extends('client.layouts.template')

@section('title','Tin tức')

@section('content')
<article id="Wrapper" class="Section">
    <div class="container">
        <section class="col-section">
            @foreach ($categoryArticles as $categoryArticle)
                <div class="boxes">
                    <div class="title-cat">
                        <span id="ctl00_ContentPlaceHolder1_lbTitleCat">{{ $categoryArticle->name }}</span>
                    </div>
                    @php
                        $articles = \App\Models\Article::where('category_article_id', $categoryArticle->id)->orderBy('view', 'DESC')->orderBy('id','DESC')->paginate(12, ['*'],'article');
                    @endphp
                    <div class="contain border clearfm">
                        @if ($articles->count() > 0)
                            <ul class="overHide feature-home">
                                @foreach ($articles as $item)
                                    <li class="item item-category">
                                        <a
                                            href="{{ route('article.detail', ['id' => $item->id]) }}">
                                            <div class="content">
                                                <div class="postImg">
                                                    <img src="{{ asset($item->thumbnail) }}"
                                                        alt="{{ $item->title }}" />
                                                </div>
                                                <span class="views">{{ $item->view }}</span>
                                            </div>
                                        </a>
                                        <h4>
                                            <a
                                                href="{{ route('article.detail', ['id' => $item->id]) }}">
                                                <span>{{ $item->title }}</span>
                                            </a>
                                        </h4>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <div style="color:white; font-size:1.2rem;">Nội dung chúng tôi sẽ cập nhật sau</div>
                        @endif
                        {{ $articles->links() }}
                    </div>
                </div>
            @endforeach
        </section>
        <aside class="col-side fixed">
            @include('client.includes.project',['projects' => $projects])
            @include('client.includes.article',['articles' => $articles])
        </aside>
    </div>
</article>
@endsection