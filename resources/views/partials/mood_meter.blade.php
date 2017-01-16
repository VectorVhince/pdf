<div class="panel panel-default bd-rad0 box-shadow">
    <div style="height: 20px;" class="bgc-red mg0"></div>
    <div class="panel-body pd15">
        <div class="mgb20">
            <div class="row">
                <div class="col-sm-12">
                    <span class="fs25">How does this story make you feel?</span>
                </div>
            </div>
            <div style="height: 2px;" class="bgc-red mg0"></div>
        </div>
        <div id="moodForm" data-url="{{ route('mood.store',$post->id) }}" data-token="{{ Session::token() }}">
          <ul class="list-inline">
            <li><button type="button" name="mood" value="happy" class="bgc0 bd0 moodBtn" data-toggle="tooltip" title="Happy"><img src="{{ asset('/img/emoticons/shout.png') }}" class="ht35"> {{ $happy }}</button></li>
            <li><button type="button" name="mood" value="love" class="bgc0 bd0 moodBtn" data-toggle="tooltip" title="Love"><img src="{{ asset('/img/emoticons/love.png') }}" class="ht35"> {{ $love }}</button></li>
            <li><button type="button" name="mood" value="shocked" class="bgc0 bd0 moodBtn" data-toggle="tooltip" title="Shocked"><img src="{{ asset('/img/emoticons/startle.png') }}" class="ht35"> {{ $shocked }}</button></li>
            <li><button type="button" name="mood" value="angry" class="bgc0 bd0 moodBtn" data-toggle="tooltip" title="Angry"><img src="{{ asset('/img/emoticons/anger.png') }}" class="ht35"> {{ $angry }}</button></li>
          </ul>
        </div>
        <div id="moodSuccess" class="dp0">
          You chose <span id="moodMessage" class="fc-red"></span> with this story.
        </div>
    </div>
</div>