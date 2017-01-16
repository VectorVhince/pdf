@extends('layouts.app')

@section('meta')
    <meta property="og:url"           content="{{ Request::url() }}" />
    <meta property="og:type"          content="article" />
    <meta property="og:title"         content="{{ $post->title }}" />
    <meta property="og:description"   content="{{ $post->body }}" />
    <meta property="og:image"         content="{{ asset('/img/uploads/' . $post->image) }}" />
@stop

@section('content')
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '273815756367661',
      xfbml      : true,
      version    : 'v2.8'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>

<script>window.twttr = (function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0],
    t = window.twttr || {};
  if (d.getElementById(id)) return t;
  js = d.createElement(s);
  js.id = id;
  js.src = "https://platform.twitter.com/widgets.js";
  fjs.parentNode.insertBefore(js, fjs);

  t._e = [];
  t.ready = function(f) {
    t._e.push(f);
  };

  return t;
}(document, "script", "twitter-wjs"));</script>

<div class="container">
    <div class="row">
        <div class="col-lg-8">
            <div class="panel panel-default bd-rad0 box-shadow panel-bg">
                <div class="bgc-red mg0 fc-white fs20 pdv5 pdh45 box-arrow2">
                  {{ ucfirst($post->category) }}
                  <span class="pull-right">
                  @if(Auth::user())
                    @if($post->approved==0)
                     <span>Pending</span>
                    @else
                      <span>Approved</span>
                    @endif
                  @endif
                  </span>
                </div>
                <div class="panel-body pdh45">
                    <div class="row mgb40">
                        <div class="col-md-10">
                            <span class="fs40">{{ $post->title }}</span>
                            <div class="dp-bl">
                                <span class="text-muted">Author: </span>{{ $post->user }} <span class="text-muted mgl10">Posted: </span>{{ date_format($post->created_at, 'F d, Y') }}
                            </div>
                        </div>
                        <div class="col-md-2">
                        @if (Auth::user())
                            @if (Auth::user()->id == $post->user_id || Auth::user()->role == 'superadmin')                                
                                <div class="dropdown" style="float: right;">
                                    <a class="dropdown-toggle" data-toggle="dropdown" id="dropdownMenu1">
                                        <div class="icon-circle text-center pdt10 mgt5">
                                            <span class="glyphicon glyphicon-th-list fs25 fc-white"></span>
                                        </div>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
                                        <div class="box-arrow1"></div>
                                        @if(Auth::user()->role == 'superadmin')
                                          @if(!$post->featured == '1')
                                          <li><a href="#!" data-toggle="modal" data-target="#modal2"><img src="{{ asset('/img/featured.png') }}" class="ht20"> Mark featured</a></li>
                                          @else
                                          <li><a href="#!" data-toggle="modal" data-target="#modal3"><img src="{{ asset('/img/unfeatured.png') }}" class="ht20"> Unmark featured</a></li>
                                          @endif
                                          @if(!$post->approved == '1')
                                          <li><a href="#!" data-toggle="modal" data-target="#modal4"><img src="{{ asset('/img/featured.png') }}" class="ht20"> Approve</a></li>
                                          @else
                                          <li><a href="#!" data-toggle="modal" data-target="#modal5"><img src="{{ asset('/img/unfeatured.png') }}" class="ht20"> Disapprove</a></li>
                                          @endif
                                        @endif
                                        <li><a href="{{ route('posts.edit',$post->id) }}"><img src="{{ asset('/img/edit.png') }}" class="ht20"> Edit</a></li>
                                        <li><a href="#!" data-toggle="modal" data-target="#modal1"><img src="{{ asset('/img/delete.png') }}" class="ht20"> Delete</a></li>
                                    </ul>
                                </div>
                            @endif
                        @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <img src="{{ asset('/img/uploads/' . $post->image) }}" class="img-responsive mgb40">
                        </div>
                    </div>
                    <div class="row mgb20">
                        <div class="col-lg-12">
                            {!! $post->body !!}
                        </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-3">
                        <span class="fs15 text-muted">Views: {{ number_format($counter) }}</span>
                      </div>
                      <div class="col-sm-3">
                        <a href="{{ route('post.pdf') }}" class="fs15 text-muted">Download PDF</a>
                      </div>
                      <div class="col-sm-3 col-sm-offset-6 pdh0">
                        <div class="social-container">
                          <div class="fb-container">
                            <div class="fb-share-button" 
                                data-href="{{ Request::url() }}" 
                                data-layout="button">
                            </div>
                          </div>

                          <div class="tw-container">
                            <a class="twitter-share-button"
                              href="https://twitter.com/intent/tweet?text=Check%20this%20article%20on%20The%20Angelite%20"
                             >
                            Tweet</a>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">

          @include('partials.mood_meter')

          @include('partials.more_stories')

        </div>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <div class="panel panel-default bd-rad0 box-shadow mgt40">
            <div style="height: 20px;" class="bgc-red mg0"></div>
                <div class="panel-body pdh45">
                    <div>
                        <span class="fs25">Comments</span>
                        <div style="height: 2px;" class="bgc-red mg0"></div>
                    </div>
                    @if(!$comments->isEmpty())
                    @foreach($comments as $comment)
                        <div class="mgv20 pdh15 bdrl1-gray commentHover" data-id="{{ $comment->id }}">
                        @if($comment->trashed())
                          <span class="dp-bl">This comment was deleted.</span>
                          <span class="pointer" data-toggle="tooltip" title="{{ date_format($comment->created_at, 'F d, Y g:i a') }}">{{ \Carbon\Carbon::createFromTimeStamp(strtotime($comment->deleted_at))->diffForHumans() }}</span>
                        @else
                          @if(Auth::user())
                            @if(Auth::user()->id == $post->user_id || Auth::user()->role == 'superadmin')
                            <span class="glyphicon glyphicon-remove pull-right pointer dp0" data-toggle="modal" data-target="#modal6" data-cid="{{ route('comment.destroy',$comment->id) }}" id="commentDeleteBtn{{ $comment->id }}"></span>
                            @endif
                          @endif
                          <span class="dp-bl fs20 mgb5">{{ $comment->name }}, {{ $comment->dept }}</span>
                            <p class="mgl20">{{ $comment->message }}</p>
                          <span class="pointer" data-toggle="tooltip" title="{{ date_format($comment->created_at, 'F d, Y g:i a') }}">{{ \Carbon\Carbon::createFromTimeStamp(strtotime($comment->created_at))->diffForHumans() }}</span>
                        @endif
                        </div>
                    @endforeach
                    @else
                    <div class="mgv20">
                        <span class="fs12">Be the first to comment</span>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="panel panel-default bd-rad0 box-shadow mgt40">
            <div style="height: 20px;" class="bgc-red mg0"></div>
                <div class="panel-body pd15">
                    <form action="{{ route('comment',$post->id) }}" method="post">
                        {{ csrf_field() }}
                        <div class="mgb20">
                            <span class="fs25">Leave a comment</span>
                            <div style="height: 2px;" class="bgc-red mg0"></div>
                        </div>
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <div class="box-shadow">
                              <input type="text" name="name" class="form-control mgb20 bd-rad0" placeholder="Name" value="{{ old('name') }}">
                            </div>
                            @if ($errors->has('name'))
                                <span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="box-shadow">
                              <input type="email" name="email" class="form-control mgb20 bd-rad0" placeholder="Email Address" value="{{ old('email') }}">
                            </div>
                            @if ($errors->has('email'))
                                <span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('dept') ? ' has-error' : '' }}">
                            <div class="box-shadow">
                              <input type="text" name="dept" class="form-control mgb20 bd-rad0" placeholder="College Department" value="{{ old('dept') }}">
                            </div>
                            @if ($errors->has('dept'))
                                <span class="help-block"><strong>{{ $errors->first('dept') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
                            <div class="box-shadow">
                              <textarea name="message" class="form-control mgb20 bd-rad0" rows="8" placeholder="Message">{{ old('message') }}</textarea>
                            </div>
                            @if ($errors->has('message'))
                                <span class="help-block"><strong>{{ $errors->first('message') }}</strong></span>
                            @endif
                        </div>
                        {!! Recaptcha::render() !!}
                        <div class="row">
                            <div class="col-md-12 text-right mgt20">
                                <div class="form-inline">
                                    <button type="submit" class="btn btn-success bd-rad0 btn-sm">Post</button>
                                    <button type="reset" class="btn btn-danger bd-rad0 btn-sm">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>        
    </div>
</div>

<div id="modal1" class="modal fade bs-example-modal-sm pdt200" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content text-center pd15">
    <form action="{{ route('posts.destroy',$post->id) }}" method="post">
    {{ csrf_field() }}
    {{ method_field('delete') }}

      <span>Delete this post?</span>
      <div class="row mgt20">
          <button type="submit" class="btn btn-danger btn-sm">Yes</button>
          <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">No</button>
      </div>

    </form>
    </div>
  </div>
</div>

<div id="modal2" class="modal fade bs-example-modal-sm pdt200" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content text-center pd15">

      <span>Mark this featured?</span>
      <div class="row mgt20">
          <a href="{{ route('posts.featured',$post->id) }}"><button type="button" class="btn btn-success btn-sm">Yes</button></a>
          <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">No</button>
      </div>

    </div>
  </div>
</div>

<div id="modal3" class="modal fade bs-example-modal-sm pdt200" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content text-center pd15">

      <span>Unmark this featured?</span>
      <div class="row mgt20">
          <a href="{{ route('posts.unfeatured',$post->id) }}"><button type="button" class="btn btn-danger btn-sm">Yes</button></a>
          <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">No</button>
      </div>

    </div>
  </div>
</div>

<div id="modal4" class="modal fade bs-example-modal-sm pdt200" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content text-center pd15">

      <span>Approve this post?</span>
      <div class="row mgt20">
          <a href="{{ route('posts.approved',$post->id) }}"><button type="button" class="btn btn-success btn-sm">Yes</button></a>
          <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">No</button>
      </div>

    </div>
  </div>
</div>

<div id="modal5" class="modal fade bs-example-modal-sm pdt200" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content text-center pd15">

      <span>Disapprove this post?</span>
      <div class="row mgt20">
          <a href="{{ route('posts.disapproved',$post->id) }}"><button type="button" class="btn btn-danger btn-sm">Yes</button></a>
          <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">No</button>
      </div>

    </div>
  </div>
</div>

<div id="modal6" class="modal fade bs-example-modal-sm pdt200" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content text-center pd15">

      <span>Delete this comment?</span>
      <div class="row mgt20">
          <a href="" id="commentDeleteUrl"><button type="button" class="btn btn-danger btn-sm">Yes</button></a>
          <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">No</button>
      </div>

    </div>
  </div>
</div>
@endsection

@section('script')
  <script type="text/javascript" src="{{ asset('/js/mood_meter.js') }}"></script>
  <script type="text/javascript">

    $('.commentHover').on('mouseenter', function(){
      var commentId = $(this).data('id');
      $('#commentDeleteBtn'+commentId).show();
    }).on('mouseleave', function(){
      var commentId = $(this).data('id');
      $('#commentDeleteBtn'+commentId).hide();
    });

    $('.glyphicon-remove').on('click',function(){
      var commentUrl = $(this).data('cid');
      // console.log(commentUrl);
      $('#commentDeleteUrl').attr('href', commentUrl);
    });

  </script>
@stop