@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default bd-rad0 box-shadow panel-bg">
                <div style="height: 20px;" class="bgc-red mg0"></div>
                <div class="panel-body pdh45">
                    <div class="mgb20">
                        <div class="row">
                            <div class="col-sm-10">
                                <span class="fs40">Terms of Service</span>
                            </div>
                            <div class="col-sm-2">
                                @if(Auth::user())
                                    @if(Auth::user()->role == 'superadmin')
                                    <div class="pointer" data-toggle="modal" data-target='#editor'><img src="{{ asset('img/edit.png') }}" class="img-responsive img-circle ht50 pull-right" data-toggle="tooltip" data-placement="bottom" title="Edit"></div>
                                    @endif
                                @endif
                            </div>
                        </div>
                        <div style="height: 2px;" class="bgc-red mg0"></div>
                    </div>                                       
                    <div class="row">
                        <div class="col-md-12">
                            {!! $category->content !!}
                        </div>
                    </div>
                </div>
            </div>        
        </div>
    </div>
</div>
@include('partials.editor')
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