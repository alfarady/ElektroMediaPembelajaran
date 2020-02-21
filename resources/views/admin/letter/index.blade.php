@extends('layouts.backend')
@section('content')
@if(request()->input('jenis_surat') != 'archive')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ action('Admin\LetterController@create', ['jenis_surat' => request()->input('jenis_surat')]) }}">
            Tambah Surat {{ request()->input('jenis_surat') == 'keluar' ? 'Keluar' : (request()->input('jenis_surat') == 'masuk' ? 'Masuk' : 'Arsip') }}
        </a>
    </div>
</div>
@endif

@if (\Session::has('response'))
    <div class="alert @if(\Session::get('response')['status']) alert-success @else alert-error @endif alert-dismissible fade show" role="alert">
        {!! \Session::get('response')['message'] !!}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<div class="card">
    <div class="card-header">
        List Surat {{ request()->input('jenis_surat') == 'keluar' ? 'Keluar' : (request()->input('jenis_surat') == 'masuk' ? 'Masuk' : 'Arsip') }}
    </div>

    <div class="card-body">
        <div class="row pb-4">
            @if(request()->input('jenis_surat') == 'keluar')
            <div class="col-md-4">
                <select class="form-control select2" name="deputy_id" id="deputy_id">
                    <option value="all">Semua Deputy</option>
                    @foreach ($deputies as $deputy)
                        <option value="{{$deputy->id}}" @if(request()->input('deputy_id') == $deputy->id) selected @endif>{{$deputy->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <select class="form-control select2" name="category_id" id="category_id">
                    <option value="all">Semua Kategori</option>
                    @foreach ($categories as $category)
                        <option value="{{$category->id}}" @if(request()->input('category_id') == $category->id) selected @endif>{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <select class="form-control select2" name="sub_category_id" id="sub_category_id">
                    <option value="all">Semua Sub Kategori</option>
                    @foreach ($sub_categories as $sub_category)
                        <option value="{{$sub_category->id}}" @if(request()->input('sub_category_id') == $sub_category->id) selected @endif>{{$sub_category->name}}</option>
                    @endforeach
                </select>
            </div>
            @elseif(request()->input('jenis_surat') == 'masuk')
            <div class="col-md-12">
                <select class="form-control select2" name="disposisi" id="disposisi">
                    <option value="all">Semua Disposisi</option>
                    <option value="dukungan_umum_sdm" @if(request()->input('disposisi') == 'dukungan_umum_sdm') selected @endif>DUKUNGAN UMUM (SDM)</option>
                    <option value="dukungan_umum_sarana" @if(request()->input('disposisi') == 'dukungan_umum_sarana') selected @endif>DUKUNGAN UMUM (SARANA)</option>
                    <option value="dukungan_umum_it" @if(request()->input('disposisi') == 'dukungan_umum_it') selected @endif>DUKUNGAN UMUM (IT)</option>
                    <option value="pelayanan" @if(request()->input('disposisi') == 'pelayanan') selected @endif>PELAYANAN</option>
                    <option value="keuangan_akuntansi" @if(request()->input('disposisi') == 'keuangan_akuntansi') selected @endif>KEUANGAN & AKUNTANSI</option>
                    <option value="penjualan_inlog" @if(request()->input('disposisi') == 'penjualan_inlog') selected @endif>PENJUALAN & INLOG</option>
                    <option value="pengolahan" @if(request()->input('disposisi') == 'pengolahan') selected @endif>PENGOLAHAN</option>
                    <option value="slpk" @if(request()->input('disposisi') == 'slpk') selected @endif>SLPK</option>
                </select>
            </div>
            @else
            <div class="col-md-12">
                <select class="form-control select2" name="date" id="date">
                    <option value="all">Semua Tahun</option>
                    <option value="2017" @if(request()->input('date') == '2017') selected @endif>2017</option>
                    <option value="2018" @if(request()->input('date') == '2018') selected @endif>2018</option>
                </select>
            </div>
            @endif
            @if(auth()->user()->hasRole('Admin'))
            <div class="col-md pt-3">
                <select class="form-control select2" name="created_by" id="created_by">
                    <option value="all">Semua Instansi</option>
                    @foreach ($users as $user)
                        <option value="{{$user->id}}" @if(request()->input('created_by') == $user->id) selected @endif>{{$user->name}}</option>
                    @endforeach
                </select>
            </div>
            @endif
        </div>
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable">
                <thead>
                    <tr>
                        <th width="8">

                        </th>
                        <th>
                            Nomor Surat
                        </th>
                        <th>
                            Tanggal Surat
                        </th>
                        <th>
                            Jenis Surat & Pengirim
                        </th>
                        <th>
                            Isi Singkat
                        </th>
                        @if(request()->input('jenis_surat') == 'masuk')
                        <th>
                            Disposisi
                        </th>
                        @endif
                        @if(request()->input('jenis_surat') != 'archive')
                        <th>
                            &nbsp;
                        </th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $value)
                    <tr data-entry-id="{{ $value->id }}">
                        <td>

                        </td>
                        <td>
                            {{$value->nomor_surat}}
                        </td>
                        <td>
                            {{$value->tanggal_surat}}
                        </td>
                        <td>
                            {{$value->perihal ?? ''}}
                        </td>
                        <td>
                            {{$value->isi_singkat}}
                        </td>
                        @if(request()->input('jenis_surat') == 'masuk')
                        @php
                            $disposisi = '';
                            switch($value->disposisi) {
                                case 'dukungan_umum_sdm':
                                    $disposisi = 'DUKUNGAN UMUM (SDM)';
                                    break;
                                case 'dukungan_umum_sarana':
                                    $disposisi = 'DUKUNGAN UMUM (SARANA)';
                                    break;
                                case 'dukungan_umum_it':
                                    $disposisi = 'DUKUNGAN UMUM (IT)';
                                    break;
                                case 'pelayanan':
                                    $disposisi = 'PELAYANAN';
                                    break;
                                case 'keuangan_akuntansi':
                                    $disposisi = 'KEUANGAN & AKUNTANSI';
                                    break;
                                case 'penjualan_inlog':
                                    $disposisi = 'PENJUALAN & INLOG';
                                    break;
                                case 'pengolahan':
                                    $disposisi = 'PENGOLAHAN';
                                    break;
                                case 'slpk':
                                    $disposisi = 'SLPK';
                                    break;
                                default:
                                    $disposisi = '';
                            }
                        @endphp
                        <td>
                            {{$disposisi}}
                        </td>
                        @endif
                        @if(request()->input('jenis_surat') != 'archive')
                        <td>
                            <a class="fa fa-edit fa-lg" href="{{ action('Admin\LetterController@edit', $value->id) }}" style="cursor:pointer;margin-right:10px;color:black"></a>
                            <i class="fa fa-trash fa-lg delete_action" href="{{ action('Admin\LetterController@destroy', $value->id) }}" style="cursor:pointer;margin-right:10px;"></i>
                        </td>
                        @endif
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
    $( document ).ready(function() {
        $('.select2').select2({ width: '100%' });
        // $('#jenis_surat').on('change', function() {
        //     if(this.value != 'all') {
        //         var url = new URL(window.location.href);
        //         url.searchParams.set('jenis_surat',this.value);
        //         window.location.href = url.href;
        //         console.log(window.location.href);
        //     } else {
        //         var url = new URL(window.location.href);
        //         url.searchParams.delete('jenis_surat');
        //         window.location.href = url.href;
        //     }
        // });
        @if(request()->input('jenis_surat') == 'keluar')
        $('#deputy_id').on('change', function() {
            if(this.value != 'all') {
                var url = new URL(window.location.href);
                url.searchParams.set('deputy_id',this.value);
                url.searchParams.delete('category_id');
                url.searchParams.delete('sub_category_id');
                window.location.href = url.href;
                console.log(window.location.href);
            } else {
                var url = new URL(window.location.href);
                url.searchParams.delete('deputy_id');
                url.searchParams.delete('category_id');
                url.searchParams.delete('sub_category_id');
                window.location.href = url.href;
            }
        });
        $('#category_id').on('change', function() {
            if(this.value != 'all') {
                var url = new URL(window.location.href);
                url.searchParams.set('category_id',this.value);
                url.searchParams.delete('sub_category_id');
                window.location.href = url.href;
                console.log(window.location.href);
            } else {
                var url = new URL(window.location.href);
                url.searchParams.delete('category_id');
                url.searchParams.delete('sub_category_id');
                window.location.href = url.href;
            }
        });
        $('#sub_category_id').on('change', function() {
            if(this.value != 'all') {
                var url = new URL(window.location.href);
                url.searchParams.set('sub_category_id',this.value);
                window.location.href = url.href;
                console.log(window.location.href);
            } else {
                var url = new URL(window.location.href);
                url.searchParams.delete('sub_category_id');
                window.location.href = url.href;
            }
        });
        @elseif(request()->input('jenis_surat') == 'masuk')
        $('#disposisi').on('change', function() {
            if(this.value != 'all') {
                var url = new URL(window.location.href);
                url.searchParams.set('disposisi',this.value);
                window.location.href = url.href;
                console.log(window.location.href);
            } else {
                var url = new URL(window.location.href);
                url.searchParams.delete('disposisi');
                window.location.href = url.href;
            }
        });
        @else
        $('#date').on('change', function() {
            if(this.value != 'all') {
                var url = new URL(window.location.href);
                url.searchParams.set('date',this.value);
                window.location.href = url.href;
                console.log(window.location.href);
            } else {
                var url = new URL(window.location.href);
                url.searchParams.delete('date');
                window.location.href = url.href;
            }
        });
        @endif
        @if(auth()->user()->hasRole('Admin'))
            $('#created_by').on('change', function() {
                if(this.value != 'all') {
                    var url = new URL(window.location.href);
                    url.searchParams.set('created_by',this.value);
                    window.location.href = url.href;
                    console.log(window.location.href);
                } else {
                    var url = new URL(window.location.href);
                    url.searchParams.delete('created_by');
                    window.location.href = url.href;
                }
            });
        @endif
    });

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
                    url: 'subdistricts/' + id,
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
  @if(request()->input('jenis_surat') != 'archive')
  dtButtons.push(deleteButton)
  @endif

  $('.datatable:not(.ajaxTable)').DataTable({ buttons: dtButtons })
})

$(document).on('click', '.edit_action', function (e) {
    e.preventDefault();
    $('div.edit_form').load($(this).attr('href'), function () {
        $(this).modal('show');
    });
});

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
