<div class="boxes">
    <div class="title-cat">
        <span>Dự án liên quan
        </span>
    </div>
    <div class="contain border clearfm">
        <ul class="overHide feature-home">
            @if ($relationProject->count() > 0)
                @foreach ($relationProject as $item)
                    <li class="item item-category">
                        <a
                            href="{{ route('product.detail', ['id' => $item->id]) }}">
                            <div class="content">
                                <div class="postImg">
                                    <img src="{{ asset($item->image->first()->image_src) }}"
                                        alt="{{ $item->name }}" />
                                </div>
                                <span class="views">{{ $item->view }}</span>
                            </div>
                        </a>
                        <h4>
                            <a
                                href="{{ route('product.detail', ['id' => $item->id]) }}">
                                <span>{{ $item->name }}</span>
                            </a>
                        </h4>
                    </li>
                @endforeach
            @else
                <div style="color:white; font-size:1.2rem;">Hiện tại chưa có dự án nào</div>
            @endif 
        </ul>
    </div>
</div>