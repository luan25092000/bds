<div class="boxes-side design-side">
    <div class="title-side">
        <span>Tin tức</span>
    </div>
    <div class="contain clearfm">
        <ul class="list-article-side">
            @foreach ($articles as $article)
                <li class="item">
                    <div class="postImg">
                        <a href="">
                            <img src="{{ asset($article->image->first()->image_src) }}" alt="{{ $article->title }}" />
                        </a>
                    </div>
                    <div class="text">
                        <h4>
                            <a href="">
                                {{ $article->title }}
                            </a>
                        </h4>
                        <div class="info transparent">
                            <span class="icon views">
                                {{ $article->view }}
                            </span>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>