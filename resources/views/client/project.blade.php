@extends('client.layouts.template')

@section('title','Dự án')

@section('content')
<article id="Wrapper" class="Section">
    <div class="container">
        <section class="col-section">
            <div class="boxes">
                <div class="title-cat">
                    <span id="ctl00_ContentPlaceHolder1_lbTitleCat">Dự án</span>
                </div>
                <div class="contain border clearfm">
                    @if (count($projects) > 0)
                        <ul class="overHide feature-home">
                            @foreach ($projects as $project)
                                <li class="item item-category">
                                    <a
                                        href="{{ route('project.detail', ['id' => $project->id]) }}">
                                        <div class="content">
                                            <div class="postImg">
                                                <img src="{{ asset($project->image->first()->image_src) }}" alt="{{ $project->name }}" />
                                            </div>
                                            <span class="views">{{ $project->view }}</span>
                                        </div>
                                    </a>
                                    <h4>
                                        <a
                                            href="{{ route('project.detail', ['id' => $project->id]) }}">
                                            <span>{{ $project->name }}</span>
                                        </a>
                                    </h4>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <div style="color:white; font-size:1.2rem;">Nội dung chúng tôi sẽ cập nhật sau</div>
                    @endif
                    {{ $projects->links() }}
                </div>
            </div>
        </section>
        <aside class="col-side fixed">
            @include('client.includes.project',['projects' => $projects])
            @include('client.includes.article',['articles' => $articles])
        </aside>
    </div>
</article>
@endsection