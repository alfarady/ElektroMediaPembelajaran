@extends('layouts.backend')
@section('content')

<div class="card">
    <div class="card-header">
        Pengaturan Perusahaan
    </div>

    <div class="card-body">
        <form action="{{ action('Admin\InstanceSettingsController@update', $user->id) }}" method="POST">
            @method('PUT')
            @csrf
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">Nama Instansi*</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($user) ? $user->name : '') }}">
                @if($errors->has('name'))
                    <p class="help-block">
                        {{ $errors->first('name') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('global.user.fields.name_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('province') ? 'has-error' : '' }}">
                <label for="province">Provinsi</label>
                <input type="text" id="province" name="province" value="{{$user->province ?? ''}}" class="form-control">
                @if($errors->has('province'))
                    <p class="help-block">
                        {{ $errors->first('province') }}
                    </p>
                @endif
            </div>
            <div class="form-group {{ $errors->has('city') ? 'has-error' : '' }}">
                <label for="city">Kota</label>
                <input type="text" id="city" name="city" value="{{$user->city ?? ''}}" class="form-control">
                @if($errors->has('city'))
                    <p class="help-block">
                        {{ $errors->first('city') }}
                    </p>
                @endif
            </div>
            <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                <label for="address">Alamat</label>
                <input type="text" id="address" name="address" value="{{$user->address ?? ''}}" class="form-control">
                @if($errors->has('address'))
                    <p class="help-block">
                        {{ $errors->first('address') }}
                    </p>
                @endif
            </div>
            <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                <label for="phone">Telephone/FAX</label>
                <input type="text" id="phone" name="phone" value="{{$user->phone ?? ''}}" class="form-control">
                @if($errors->has('phone'))
                    <p class="help-block">
                        {{ $errors->first('phone') }}
                    </p>
                @endif
            </div>
            <div class="form-group {{ $errors->has('total_outbox') ? 'has-error' : '' }}">
                <label for="total_outbox">Jumlah Nomor Surat Terkini</label>
                <input type="number" id="total_outbox" name="total_outbox" value="{{$user->total_outbox ?? 0}}" class="form-control">
                @if($errors->has('total_outbox'))
                    <p class="help-block">
                        {{ $errors->first('total_outbox') }}
                    </p>
                @endif
            </div>
            <div>
                <input class="btn btn-success" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>
    </div>
    <div>
        <button class="btn btn-danger close_book m-4 pull-right" href="{{action('Admin\InstanceSettingsController@destroy', 0)}}">Tutup Buku Tahunan</button>
    </div>
</div>
@endsection
@section('js_after')
<script>
$(document).on('click', '.close_book', function(e) {
    e.preventDefault();

    Swal.fire({
        title: 'Yakin?',
        text: "Anda akan menutup buku tahun ini!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'TUTUP!'
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