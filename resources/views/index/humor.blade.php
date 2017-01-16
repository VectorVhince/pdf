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
                                <span class="fs40">Humor</span>
                            </div>
                            <div class="col-sm-4 col-sm-offset-2 mgt10">
                            <form action="{{ route('sortBy','humor') }}" method="get">
                                <div class="box-shadow">
                                    <select class="form-control input-sm bd-rad0" name="key" onchange="this.form.submit()">
                                        <option disabled selected>Sort By</option>
                                        <option value="date">Date</option>
                                        <option value="name">Name</option>
                                        <option value="views">Popularity</option>
                                    </select>
                                </div>
                            </form>
                            </div>
                        </div>
                        <div style="height: 2px;" class="bgc-red mg0"></div>
                    </div>
                    @if(!$humor->isEmpty())
                    @foreach($humor as $new)
                    <a href="{{ route('posts.show', $new->id) }}" class="fc-black">
                        <div class="bg-blue-hover pd10">
                            <div class="row mgb20">
                                <div class="col-md-12">
                                    <span class="dp-bl fs25">{{ $new->title }}</span>
                                    <span class="text-muted">Author: </span>{{ $new->user }} <span class="text-muted mgl10">Posted: </span>{{ date_format($new->created_at, 'F d, Y') }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <img src="{{ asset('/img/uploads/thumbnails/' . $new->image) }}" class="img-responsive img-thumbnail">
                                </div>
                                <div class="col-md-8">
                                    {{ strip_tags(substr($new->body,0,400)) }}...
                                </div>
                            </div>
                        </div>
                    </a>
                    <div style="height: 1px;" class="bgc-gray mgv20"></div>
                    @endforeach
                    @else
                    Nothing posted.
                    @endif
                    {{ $humor->links() }}
                </div>
            </div>        
        </div>
        <div class="col-lg-4">
            @include('partials.fromweb')
            @include('partials.archive')
        </div>
    </div>
</div>
@include('partials.editor_sm')
@endsection

@section('script')
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script type="text/javascript">
        $(document).on('focusin', function(e) {
            if ($(e.target).closest(".mce-window").length) {
                e.stopImmediatePropagation();
            }
        });

        function setPlainText() {
            var ed = tinyMCE.get('textarea');

            ed.pasteAsPlainText = true;  

            //adding handlers crossbrowser
            if (tinymce.isOpera || /Firefox\/2/.test(navigator.userAgent)) {
                ed.onKeyDown.add(function (ed, e) {
                    if (((tinymce.isMac ? e.metaKey : e.ctrlKey) && e.keyCode == 86) || (e.shiftKey && e.keyCode == 45))
                        ed.pasteAsPlainText = true;
                });
            } else {            
                ed.onPaste.addToTop(function (ed, e) {
                    ed.pasteAsPlainText = true;
                });
            }
        };

        tinymce.init({ 
            selector:'textarea',
            height: '100',
            plugins: [
            'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            'searchreplace wordcount visualblocks visualchars code fullscreen',
            'insertdatetime media nonbreaking save table contextmenu directionality',
            'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc autoresize'
            ],
            toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
            toolbar2: 'print preview media | forecolor backcolor emoticons | codesample',
            image_advtab: true,
            templates: [
            { title: 'Test template 1', content: 'Test 1' },
            { title: 'Test template 2', content: 'Test 2' }
            ],
            oninit : "setPlainText",
            menubar: false,
            statusbar: false,
            media_live_embeds: true,
            media_strict: false,
            setup : function(ed){
                ed.on('init', function(){
                    this.getDoc().body.style.fontSize = '13px';
                    this.getDoc().body.style.fontFamily = 'Helvetica';
                    this.getDoc().body.style.color = '#555';
                });
            }
        });

        $('#featured').on('change', function(){
            if (this.checked) {
                $('#unfeatured').prop('checked', false);
                $('#unfeatured').attr('name', '');
                $(this).attr('name', 'featured');
            }
            else{
                $('#unfeatured').prop('checked', true);
                $('#unfeatured').attr('name', 'featured');
                $(this).attr('name', '');
            };            
        })
    </script>
@stop