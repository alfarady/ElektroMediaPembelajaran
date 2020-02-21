<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Kategori</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <form action="{{ action('Admin\CategoryController@update', $category->id) }}" method="POST">
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
                            <select class="form-control" name="deputy_id">
                                @foreach($deputies as $deputy)
                                    <option value="{{ $deputy->id }}" @if($deputy->id == $category->deputy_id) selected @endif>{{ $deputy->name }}</option>
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
                            <input name="name" class="form-control" placeholder="Kategori" value="{{$category->name}}" type="text" required autofocus>
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
                            <input name="singkatan" class="form-control" placeholder="Singkatan Kategori" value="{{$category->singkatan ?? ''}}" type="text" required autofocus>
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
