<div class="panel panel-default bd-rad0 box-shadow">
    <div style="height: 20px;" class="bgc-red mg0"></div>
    <div class="panel-body pd15">
        <div class="mgb20">
            <div class="row">
                <div class="col-sm-12">
                    <span class="fs25">More Stories</span>
                </div>
            </div>
            <div style="height: 2px;" class="bgc-red mg0"></div>
        </div>
        @if(!$stories->isEmpty())
          @foreach($stories as $story)
            <a href="{{ route('posts.show', $story->id) }}" class="fc-black dp-bl">
              <div class="row mg0 bg-blue-hover pd5">
                <div class="col-sm-4 pdl0">
                  <img src="{{ asset('img/uploads/thumbnails/' . $story->image) }}" class="img-responsive img-thumbnail dp-bl">
                </div>
                <div class="col-sm-8 pdl0">
                  <span class="fs17 dp-bl"><b>{{ $story->title }}</b></span>
                </div>
              </div>
            </a>
            <div style="height: 1px;" class="bgc-gray mgv20"></div>
          @endforeach
        @else
          <span class="text-center">No other stories yet.</span>
        @endif
    </div>
</div>