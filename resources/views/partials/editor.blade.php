<div class="modal fade" tabindex="-1" role="dialog" id="editor">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class="modal-title">
          Malupit na Editor
        </div>
      </div>
      <form action="{{ route($category->category.'.update',$category->id) }}" method="post">
      {{ csrf_field() }}
      {{ method_field('patch') }}
      <div class="modal-body">
        <div class="box-shadow">
            <textarea name="content" class="form-control mgb20 bd-rad0 ht500" placeholder="Content">{!! $category->content !!}</textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->