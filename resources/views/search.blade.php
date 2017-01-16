@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-9">
            <div class="panel panel-default bd-rad0 box-shadow">
                <div style="height: 20px;" class="bgc-red mg0"></div>
                <div class="panel-body pdh45">
                    <span>Search results for: <b>{{ $search }}</b> <br>Found: <b>{{ $count }}</b></span>
                    <div style="height: 2px;" class="bgc-red mg0 mgv20"></div>
                    @foreach($items as $item)
                    <a href="{{ route('posts.show', $item->id) }}" class="fc-black">
                        <div class="bg-blue-hover pd10">
                            <div class="row mgb20">
                                <div class="col-md-12">
                                    <span class="dp-bl fs25">{{ $item->title }}</span>
                                    <span class="text-muted">Author: </span>{{ $item->user }} <span class="text-muted mgl10">Posted: </span>{{ date_format($item->created_at, 'F d, Y') }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <img src="{{ asset('/img/uploads/thumbnails/' . $item->image) }}" class="img-responsive img-thumbnail">
                                </div>
                                <div class="col-md-8">
                                    {{ strip_tags(substr($item->body,0,400)) }}...
                                </div>
                            </div>
                        </div>
                    </a>
                    <div style="height: 1px;" class="bgc-gray mgv20"></div>
                    @endforeach
                    {{ $items->links() }}
                </div>
            </div>        
        </div>
    </div>
</div>
@endsection