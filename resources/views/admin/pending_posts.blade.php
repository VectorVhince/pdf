@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-8">
            <div class="panel panel-default bd-rad0 box-shadow panel-bg">
                <div style="height: 20px;" class="bgc-red mg0"></div>
                <div class="panel-body pdh45">
                    <div class="mgb20">
                        <div class="row">
                            <div class="col-sm-6">
                                <span class="fs40">Pending Posts</span>
                            </div>
                            <div class="col-sm-4 col-sm-offset-2 mgt10">
                            <form action="{{ route('pending.sortBy') }}" method="get">
                                <div class="box-shadow">
                                    <select class="form-control input-sm bd-rad0" name="key" onchange="this.form.submit()">
                                        <option disabled selected>Sort By</option>
                                        <option value="date">Date</option>
                                        <option value="name">Name</option>
                                    </select>
                                </div>
                            </form>
                            </div>
                        </div>
                        <div style="height: 2px;" class="bgc-red mg0"></div>
                    </div>
                    @if(!$posts->isEmpty())
                    @foreach($posts as $post)
                    <a href="{{ route('posts.show', $post->id) }}" class="fc-black">
                        <div class="bg-blue-hover pd10">
                            <div class="row mgb20">
                                <div class="col-md-12">
                                    <span class="dp-bl fs15">{{ ucfirst($post->category) }}</span> <span class="pull-right">@if($post->approved==0) <span>Pending</span> @else Approved @endif</span>
                                    <span class="dp-bl fs25">{{ $post->title }}</span>
                                    <span class="text-muted">Author: </span>{{ $post->user }} <span class="text-muted mgl10">Posted: </span>{{ date_format($post->created_at, 'F d, Y') }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <img src="{{ asset('/img/uploads/thumbnails/' . $post->image) }}" class="img-responsive img-thumbnail">
                                </div>
                                <div class="col-md-8">
                                    {{ strip_tags(substr($post->body,0,400)) }}...
                                </div>
                            </div>
                        </div>
                    </a>
                    <div style="height: 1px;" class="bgc-gray mgv20"></div>
                    @endforeach
                    @else
                    Nothing posted.
                    @endif
                    
                </div>
            </div>        
        </div>
    </div>
</div>
@endsection