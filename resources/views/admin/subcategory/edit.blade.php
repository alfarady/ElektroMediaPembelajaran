<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Sub Kategori</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <form action="{{ action('Admin\SubcategoryController@update', $subcategory->id) }}" method="POST">
    @csrf
    @method('PUT')
      <div class="modal-body">
            <div class="row">
                <div class="col-md">
                    <div class="form-group">
                        <div class="input-group mb-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-city"></i></span>
                            </div>
                            <select class="form-control select2" name="category_id">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" @if($category->id == $subcategory->category_id) selected @endif>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md">
                    <div class="form-group">
                        <div class="input-group mb-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-city"></i></span>
                            </div>
                            <input name="name" class="form-control" placeholder="Sub Kategori" value="{{$subcategory->name}}" type="text" required autofocus>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md">
                    <div class="form-group">
                        <div class="input-group mb-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-city"></i></span>
                            </div>
                            <input name="index" class="form-control" placeholder="Index Sub Kategori" value="{{$subcategory->index}}" type="number" required autofocus>
                        </div>
                    </div>
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" value="Save changes">
      </div>
    </form>
    </div>
</div>
<script>
$(document).ready(function() {
    $('.select2').select2({ width: '90%' });
});
</script>