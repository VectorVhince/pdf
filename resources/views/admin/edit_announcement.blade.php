@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default bd-rad0 box-shadow">
                <div style="height: 20px;" class="bgc-red mg0"></div>
                <div class="panel-body pdh45">
                    <form action="{{ route('update.announcement',$announcement->id) }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('patch') }}
                        <div class="mgb40 text-center">
                            <span class="fs40">Edit Announcement</span>
                            <div style="height: 2px;" class="bgc-red mg0"></div>
                        </div>
                        <input type="hidden" name="user" value="{{ Auth::user()->name }}">
                        <input type="hidden" name="update" value="{{ Auth::user()->name }}">
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
                            <div class="box-shadow">
                                <textarea name="body" class="form-control mgb20 bd-rad0 ht500" placeholder="Content">{{ $announcement->body }}</textarea>
                            </div>
                            @if ($errors->has('body'))
                                <span class="help-block"><strong>{{ $errors->first('body') }}</strong></span>
                            @endif
                        </div>
                        <div class="col-md-4 col-md-offset-4 text-center mgt40">
                            <div class="form-inline">
                                <button type="submit" class="btn btn-success bd-rad0 fs20">Update</button>
                                <button type="reset" class="btn btn-danger bd-rad0 fs20">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</div>
@endsection

@section('script')

    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script type="text/javascript">
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
            plugins: "autoresize paste",
            toolbar: "bold italic underline",
            oninit : "setPlainText",
            menubar: false,
            statusbar: false,
            force_br_newlines : true,
            force_p_newlines : false,
            forced_root_block : '',
            setup : function(ed){
                ed.on('init', function(){
                    this.getDoc().body.style.fontSize = '13px';
                    this.getDoc().body.style.fontFamily = 'Helvetica';
                    this.getDoc().body.style.color = '#555';
                });
            }
        });
    </script>
@stop