@extends('layouts.backend')
@section('content')

<div class="card">
    <div class="card-header">
        Semua Materi
        <a type="button"
            class="btn btn-primary float-right"
            href="{{ action('MateriController@create') }}">{{ __('Tambah Materi') }}</a>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable">
                <thead>
                    <tr>
                        <th width="8">

                        </th>
                        <th>
                            Materi
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $value)
                    <tr data-entry-id="{{ $value->id }}">
                        <td>

                        </td>
                        <td>
                            {{$value->name}}
                        </td>
                        <td>
                            <a class="fa fa-edit fa-lg" style="color: black" href="{{ action('MateriController@edit', $value->id) }}" style="cursor:pointer;margin-right:10px;"></a>
                            <i class="fa fa-trash fa-lg delete_action" href="{{ action('MateriController@destroy', $value->id) }}" style="cursor:pointer;margin-right:10px;"></i>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade bd-example-modal-lg add_form" style="z-index: 9999;" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true"></div>
<div class="modal fade bd-example-modal-lg edit_form" style="z-index: 9999;" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true"></div>

@endsection
@section('js_after')
@parent
<script>
    $(function () {
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Tidak ada data yang dipilih!',
        })

        return
      }

      Swal.fire({
            title: 'Yakin?',
            text: "Anda akan menghapus data yang dipilih!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            let promises = Promise.all(ids.map(function (id) {
                return $.ajax({
                    url: 'materi/' + id,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(result) {
                        //
                    },
                });
            })).then(results => {
                location.reload();
            })
        });
    }
  }
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
  dtButtons.push(deleteButton)

  $('.datatable:not(.ajaxTable)').DataTable({ buttons: dtButtons })
})

$(document).on('click', '.delete_action', function(e) {
    e.preventDefault();

    Swal.fire({
        title: 'Yakin?',
        text: "Anda akan menghapus data yang dipilih!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: $(this).attr('href'),
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(result) {
                    console.log(result);
                    if(result.status) {
                        Swal.fire(
                            'Berhasil!',
                            result.message,
                            'success'
                        ).then(result => {
                            location.reload();
                        })
                    } else {
                        Swal.fire(
                            'Gagal!',
                            result.message,
                            'error'
                        )
                    }
                },
            });
        }
    })
            
});
</script>
@endsection
