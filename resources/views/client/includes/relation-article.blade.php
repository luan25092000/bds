<div class="boxes">
    <div class="title-cat">
        <span>Bài viết liên quan
        </span>
    </div>
    <div class="contain border clearfm">
        <ul class="overHide feature-home">  
            @if ($relationArticle->count() > 0)
                @foreach ($relationArticle as $item)
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
            @else
                <div style="color:white; font-size:1.2rem;">Hiện tại chưa có bài viết nào</div>
            @endif 
        </ul>
    </div>
</div>