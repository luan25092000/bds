<div class="boxes-side design-side">
    <div class="title-side">
        <span>Dự án</span>
    </div>
    <div class="contain clearfm">
        <ul class="list-article-side">
            @foreach ($projects as $project)
                <li class="item">
                    <div class="postImg">
                        <a href="">
                            <img src="{{ asset($project->image->first()->image_src) }}" alt="{{ $project->name }}" />
                        </a>
                    </div>
                    <div class="text">
                        <h4>
                            <a href="">
                                {{ $project->name }}
                            </a>
                        </h4>
                        <div class="info transparent">
                            <span class="icon views">
                                {{ $project->view }}
                            </span>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>