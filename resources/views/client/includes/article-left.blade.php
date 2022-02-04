@foreach ($leftArticle as $item)
    <div class="feature-category">
        <div class="postImg">
            <a
                href="{{ route('article.detail', ['id' => $item->id]) }}">
                <img src="{{ asset($item->thumbnail) }}"
                    alt="{{ $item->title }}" />
            </a>
            <span class="views">{{ $item->view }}</span>
        </div>
        <h4>
            <a
                href="{{ route('article.detail', ['id' => $item->id]) }}">
                {{ $item->title }}
            </a>
        </h4>
        <div class="desc" style="text-align: justify;">
            {!! $item->description !!}
        </div>
    </div>
@endforeach