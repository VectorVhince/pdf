<div class="panel panel-default bd-rad0 box-shadow">
    <div style="height: 20px;" class="bgc-red mg0"></div>
    <div class="panel-body pd15">
        <div class="mgb20">
            <span class="fs25">Archive</span>
            <div style="height: 2px;" class="bgc-red mg0"></div>
        </div>

        @if(!$archive_year->isEmpty())
        <ul class="archive" id="accordion1">
            @foreach($archive_year as $year => $posts)
            <li>
                <a data-toggle="collapse" data-parent="#accordion1" href="#collapse{{ $year }}">{{ $year }}</a>
                <ul id="collapse{{ $year }}" class="collapse">
                    @foreach($posts as $post)
                    <li><a href="{{ route('posts.show',$post->id) }}">{{ $post->title }}</a></li>
                    @endforeach
                </ul>
            </li>
            @endforeach
        </ul>
        @else
        <span class="text-center">Nothing posted yet.</span>
        @endif

    </div>
</div>