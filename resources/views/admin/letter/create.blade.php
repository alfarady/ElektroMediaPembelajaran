@extends('layouts.backend')
@section('content')

<div class="card">
    <div class="card-header">
        Tambah Surat
    </div>

    <div class="card-body">
        <form action="{{ action('Admin\LetterController@store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group {{ $errors->has('deputy_id') ? 'has-error' : '' }}">
                        <label for="deputy_id">Deputy*</label>
                        <select class="form-control" id="deputy_id" name="deputy_id" required>
                            <option>Pilih Deputy</option>
                            @foreach ($deputies as $deputy)
                                <option value="{{$deputy->id}}">{{$deputy->name}}</option>
                            @endforeach
                        </select>
                        @if($errors->has('deputy_id'))
                            <p class="help-block">
                                {{ $errors->first('deputy_id') }}
                            </p>
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
                        <label for="category_id">Kategori*</label>
                        <select class="form-control" id="category_id" name="category_id" required>
                            <option>Pilih Kategori</option>
                        </select>
                        @if($errors->has('category_id'))
                            <p class="help-block">
                                {{ $errors->first('category_id') }}
                            </p>
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group {{ $errors->has('sub_category_id') ? 'has-error' : '' }}">
                        <label for="sub_category_id">Sub Kategori*</label>
                        <select class="form-control" id="sub_category_id" name="sub_category_id" required>
                            <option>Pilih Sub Kategori</option>
                        </select>
                        @if($errors->has('sub_category_id'))
                            <p class="help-block">
                                {{ $errors->first('sub_category_id') }}
                            </p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="form-group {{ $errors->has('jenis_surat') ? 'has-error' : '' }}">
                <label for="jenis_surat">Jenis Surat*</label>
                <select class="form-control" id="jenis_surat" name="jenis_surat" required>
                    <option value="masuk">Masuk</option>
                    <option value="keluar">Keluar</option>
                </select>
                @if($errors->has('jenis_surat'))
                    <p class="help-block">
                        {{ $errors->first('jenis_surat') }}
                    </p>
                @endif
            </div>

            <div class="form-group {{ $errors->has('nomor_surat') ? 'has-error' : '' }}">
                <label for="nomor_surat">Nomor Surat*</label>
                <input type="text" id="nomor_surat" name="nomor_surat" class="form-control" value="{{ old('nomor_surat', isset($letter) ? $letter->nomor_surat : '') }}" required>
                @if($errors->has('nomor_surat'))
                    <p class="help-block">
                        {{ $errors->first('nomor_surat') }}
                    </p>
                @endif
            </div>

            <div class="form-group {{ $errors->has('tanggal_surat') ? 'has-error' : '' }}">
                <label for="tanggal_surat">Tanggal Surat*</label>
                <input type="text" id="tanggal_surat" name="tanggal_surat" class="form-control" placeholder="25/01/2020" value="{{ old('tanggal_surat', isset($letter) ? $letter->tanggal_surat : '') }}" pattern="\d{1,2}/\d{1,2}/\d{4}" required>
                @if($errors->has('tanggal_surat'))
                    <p class="help-block">
                        {{ $errors->first('tanggal_surat') }}
                    </p>
                @endif
            </div>

            <div class="form-group {{ $errors->has('perihal') ? 'has-error' : '' }}">
                <label for="perihal">Perihal*</label>
                <textarea class="form-control" id="perihal" name="perihal" required></textarea>
                @if($errors->has('perihal'))
                    <p class="help-block">
                        {{ $errors->first('perihal') }}
                    </p>
                @endif
            </div>

            <div class="form-group {{ $errors->has('isi_singkat') ? 'has-error' : '' }}">
                <label for="isi_singkat">Isi Singkat*</label>
                <textarea class="form-control" id="isi_singkat" name="isi_singkat" required></textarea>
                @if($errors->has('isi_singkat'))
                    <p class="help-block">
                        {{ $errors->first('isi_singkat') }}
                    </p>
                @endif
            </div>

            <div>
                <input class="btn btn-success" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>
    </div>
</div>
@endsection

@section('js_after')
    <script>
        $( document ).ready(function() {
        $('#deputy_id').change();
        });

        $('#deputy_id').on('change', function() {
            $.ajax({
                type: 'GET',
                url: 'get_cat/' + this.value,
                success: function (data) {
                    var $category_id = $('#category_id');
                    var $sub_category_id = $('#sub_category_id');
                    $category_id.empty();
                    $category_id.append('<option>Pilih Kategori</option>');
                    $sub_category_id.empty();
                    $sub_category_id.append('<option>Pilih Sub Kategori</option>');
                    for (var i = 0; i < data.length; i++) {
                        $category_id.append('<option value=' + data[i].id + '>' + data[i].name + '</option>');
                    }
                    $category_id.change();

                }
            });
        });

        $('#category_id').on('change', function() {
            $.ajax({
                type: 'GET',
                url: 'get_sub_cat/' + this.value,
                success: function (data) {
                    var $sub_category_id = $('#sub_category_id');
                    $sub_category_id.empty();
                    $sub_category_id.append('<option>Pilih Sub Kategori</option>');
                    for (var i = 0; i < data.length; i++) {
                        $sub_category_id.append('<option value=' + data[i].id + '>' + data[i].name + '</option>');
                    }
                    $sub_category_id.change();

                }
            });
        });

        $('#jenis_surat').on('change', function() {
            if(this.value == 'keluar') {
                if($('#deputy_id').val() == 'Pilih Deputy' || $('#category_id').val() == 'Pilih Kategori' || $('#sub_category_id').val() == 'Pilih Sub Kategori')
                {
                    $(this).val('masuk');
                    return Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Isi form deputy / kategori / sub kategori!',
                    })
                }
                $('#nomor_surat').prop('readonly', true);
                $.ajax({
                    type: 'GET',
                    url: 'get_ref_no/' + $('#deputy_id').val() + '/' + $('#category_id').val() + '/' + $('#sub_category_id').val(),
                    success: function (data) {
                        console.log(data);
                        $('#nomor_surat').val(data);
                    }
                });
            } else {
                $('#nomor_surat').prop('readonly', false);
                $('#nomor_surat').val('');
            } 
        });
    </script>    
@endsection