<div class="right nth-feature">
    <ul class="overHide">
        @foreach ($rightArticle as $item)
            <li class="item">
                <div class="postImg">
                    <a
                        href="{{ route('article.detail', ['id' => $item->id]) }}">
                        <img src="{{ asset($item->thumbnail) }}"
                            alt="{{ $item->title }}" />
                    </a>
                    <span class="views">{{ $item->view }}</span>
                </div>
                <div class="text">
                    <h4>
                        <a
                            href="{{ route('article.detail', ['id' => $item->id]) }}">
                            {{ $item->title }}
                        </a>
                    </h4>
                    <div class="desc" style="text-align: justify;color:white;">
                        {!! $item->description !!}
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
</div>