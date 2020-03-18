@extends('layouts.backend')
@section('content')

<div class="card">
    <div class="card-header">
        Nama Siswa: <strong>{{ $user->name }}</strong>
    </div>
        
    <div class="card-body soal_container">
        <div class="row">
            <div class="col-6 col-xl-3">
                <a class="block block-link-shadow text-right" href="javascript:void(0)">
                    <div class="block-content block-content-full clearfix">
                        <div class="float-left mt-10">
                            <i class="fa fa-scroll fa-3x text-primary"></i>
                        </div>
                        <div class="font-size-h3 font-w600" data-toggle="countTo" data-speed="1000" data-to="{{ $user->jumlah_soal }}">0</div>
                        <div class="font-size-sm font-w600 text-uppercase text-muted">Jumlah Soal</div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-xl-3">
                <a class="block block-link-shadow text-right" href="javascript:void(0)">
                    <div class="block-content block-content-full clearfix">
                        <div class="float-left mt-10">
                            <i class="fa fa-check fa-3x text-success"></i>
                        </div>
                        <div class="font-size-h3 font-w600" data-toggle="countTo" data-speed="1000" data-to="{{ $user->jumlah_benar }}">0</div>
                        <div class="font-size-sm font-w600 text-uppercase text-muted">Jumlah Benar</div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-xl-3">
                <a class="block block-link-shadow text-right" href="javascript:void(0)">
                    <div class="block-content block-content-full clearfix">
                        <div class="float-left mt-10">
                            <i class="fa fa-times fa-3x text-danger"></i>
                        </div>
                        <div class="font-size-h3 font-w600" data-toggle="countTo" data-speed="1000" data-to="{{ $user->jumlah_salah }}">0</div>
                        <div class="font-size-sm font-w600 text-uppercase text-muted">Jumlah Salah</div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-xl-3">
                <a class="block block-link-shadow text-right" href="javascript:void(0)">
                    <div class="block-content block-content-full clearfix">
                        <div class="float-left mt-10">
                            <i class="fa fa-star fa-3x text-warning"></i>
                        </div>
                        <div class="font-size-h3 font-w600" data-toggle="countTo" data-speed="1000" data-to="{{ $user->nilai }}">0</div>
                        <div class="font-size-sm font-w600 text-uppercase text-muted">Nilai</div>
                    </div>
                </a>
            </div>
        </div>
        @foreach ($data as $key => $item)
            <div class="form-group">
                <div class="input-group mb-2 mr-sm-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">{{$item->nomor}}</div>
                    </div>
                    {!! Form::text('soal['.$item->id.'][soal]', $item->soal, 
                        ['id' => 'soal', 'class' => 'form-control', 'readonly', 'placeholder' => 'Ketik Soal', 'readonly']); 
                    !!}
                </div>
                <div class="row">
                    <div class="col-sm-1">
                    </div>
                    <div class="col-sm">
                        <div class="input-group mb-2 mr-sm-2">
                            <div class="input-group-prepend">
                            <div class="input-group-text">A.</div>
                            </div>
                            @php
                                if($item->pilihan_id == $item->pilihan[0]->id && $item->pilihan[0]->is_jawaban)
                                    $class[0] = 'is-valid';
                                else if($item->pilihan_id != $item->pilihan[0]->id && $item->pilihan[0]->is_jawaban)
                                    $class[0] = 'is-valid';
                                else if($item->pilihan_id == $item->pilihan[0]->id && !$item->pilihan[0]->is_jawaban)
                                    $class[0] = 'is-invalid';
                                else
                                    $class[0] = '';     
                            @endphp
                            {!! Form::text('soal['.$item->id.'][pilihan]['.$item->pilihan[0]->id.'][name]', $item->pilihan[0]->pilihan, 
                                ['id' => 'soal', 'class' => 'form-control '.$class[0], 'readonly', 'placeholder' => 'Ketik Pilihan', 'readonly']); 
                            !!}
                            @if ($item->pilihan_id == $item->pilihan[0]->id && $item->pilihan[0]->is_jawaban)
                                <div class="valid-feedback ml-5">
                                    Jawaban Siswa Benar
                                </div>
                            @elseif ($item->pilihan_id != $item->pilihan[0]->id && $item->pilihan[0]->is_jawaban)
                                <div class="valid-feedback ml-5">
                                    Jawaban Benar
                                </div>
                            @elseif ($item->pilihan_id == $item->pilihan[0]->id && !$item->pilihan[0]->is_jawaban)
                                <div class="invalid-feedback ml-5">
                                    Jawaban Siswa Salah
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm">
                        <div class="input-group mb-2 mr-sm-2">
                            <div class="input-group-prepend">
                            <div class="input-group-text">B.</div>
                            </div>
                            @php
                                if($item->pilihan_id == $item->pilihan[1]->id && $item->pilihan[1]->is_jawaban)
                                    $class[1] = 'is-valid';
                                else if($item->pilihan_id != $item->pilihan[1]->id && $item->pilihan[1]->is_jawaban)
                                    $class[1] = 'is-valid';
                                else if($item->pilihan_id == $item->pilihan[1]->id && !$item->pilihan[1]->is_jawaban)
                                    $class[1] = 'is-invalid';
                                else
                                    $class[1] = '';    
                            @endphp
                            {!! Form::text('soal['.$item->id.'][pilihan]['.$item->pilihan[1]->id.'][name]', $item->pilihan[1]->pilihan, 
                                ['id' => 'soal', 'class' => 'form-control '.$class[1], 'readonly', 'placeholder' => 'Ketik Pilihan', 'readonly']); 
                            !!}
                            @if ($item->pilihan_id == $item->pilihan[1]->id && $item->pilihan[1]->is_jawaban)
                                <div class="valid-feedback ml-5">
                                    Jawaban Siswa Benar
                                </div>
                            @elseif ($item->pilihan_id != $item->pilihan[1]->id && $item->pilihan[1]->is_jawaban)
                                <div class="valid-feedback ml-5">
                                    Jawaban Benar
                                </div>
                            @elseif ($item->pilihan_id == $item->pilihan[1]->id && !$item->pilihan[1]->is_jawaban)
                                <div class="invalid-feedback ml-5">
                                    Jawaban Siswa Salah
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm">
                        <div class="input-group mb-2 mr-sm-2">
                            <div class="input-group-prepend">
                            <div class="input-group-text">C.</div>
                            </div>
                            @php
                                if($item->pilihan_id == $item->pilihan[2]->id && $item->pilihan[2]->is_jawaban)
                                    $class[2] = 'is-valid';
                                else if($item->pilihan_id != $item->pilihan[2]->id && $item->pilihan[2]->is_jawaban)
                                    $class[2] = 'is-valid';
                                else if($item->pilihan_id == $item->pilihan[2]->id && !$item->pilihan[2]->is_jawaban)
                                    $class[2] = 'is-invalid';
                                else
                                    $class[2] = '';   
                            @endphp
                            {!! Form::text('soal['.$item->id.'][pilihan]['.$item->pilihan[2]->id.'][name]', $item->pilihan[2]->pilihan, 
                                ['id' => 'soal', 'class' => 'form-control '.$class[2], 'readonly', 'placeholder' => 'Ketik Pilihan', 'readonly']); 
                            !!}
                            @if ($item->pilihan_id == $item->pilihan[2]->id && $item->pilihan[2]->is_jawaban)
                                <div class="valid-feedback ml-5">
                                    Jawaban Siswa Benar
                                </div>
                            @elseif ($item->pilihan_id != $item->pilihan[2]->id && $item->pilihan[2]->is_jawaban)
                                <div class="valid-feedback ml-5">
                                    Jawaban Benar
                                </div>
                            @elseif ($item->pilihan_id == $item->pilihan[2]->id && !$item->pilihan[2]->is_jawaban)
                                <div class="invalid-feedback ml-5">
                                    Jawaban Siswa Salah
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm">
                        <div class="input-group mb-2 mr-sm-2">
                            <div class="input-group-prepend">
                            <div class="input-group-text">D.</div>
                            </div>
                            @php
                                if($item->pilihan_id == $item->pilihan[3]->id && $item->pilihan[3]->is_jawaban)
                                    $class[3] = 'is-valid';
                                else if($item->pilihan_id != $item->pilihan[3]->id && $item->pilihan[3]->is_jawaban)
                                    $class[3] = 'is-valid';
                                else if($item->pilihan_id == $item->pilihan[3]->id && !$item->pilihan[3]->is_jawaban)
                                    $class[3] = 'is-invalid';
                                else
                                    $class[3] = '';
                            @endphp
                            {!! Form::text('soal['.$item->id.'][pilihan]['.$item->pilihan[3]->id.'][name]', $item->pilihan[3]->pilihan, 
                                ['id' => 'soal', 'class' => 'form-control '.$class[3], 'readonly', 'placeholder' => 'Ketik Pilihan', 'readonly']); 
                            !!}
                            @if ($item->pilihan_id == $item->pilihan[3]->id && $item->pilihan[3]->is_jawaban)
                                <div class="valid-feedback ml-5">
                                    Jawaban Siswa Benar
                                </div>
                            @elseif ($item->pilihan_id != $item->pilihan[3]->id && $item->pilihan[3]->is_jawaban)
                                <div class="valid-feedback ml-5">
                                    Jawaban Benar
                                </div>
                            @elseif ($item->pilihan_id == $item->pilihan[3]->id && !$item->pilihan[3]->is_jawaban)
                                <div class="invalid-feedback ml-5">
                                    Jawaban Siswa Salah
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach        
    </div>
</div>

@endsection
@section('js_after')
@parent
<script>
    @if(count($data) <= 0)
    $(document).ready(function() {
        $.ajax({
            url: '{{ action('SoalController@getSoalForm') }}',
            data: { 
                count: $(".soal_container").find('.form-group').length + 1
            },
            dataType: 'html',
            success: function(result) {
                $('.soal_container').append(result);
            },
        });
    });
    @endif

    $('.increase_soal').on('click', function() {
        $.ajax({
            url: '{{ action('SoalController@getSoalForm') }}',
            data: { 
                count: $(".soal_container").find('.form-group').length + 1
            },
            dataType: 'html',
            success: function(result) {
                $('.soal_container').append(result);
            },
        });
    })

    $('.decrease_soal').on('click', function(e) {
        e.preventDefault()

        var parentFormGroup = $(this).parent().parent();
        
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
                        if(result.status) {
                            Swal.fire(
                                'Berhasil!',
                                result.message,
                                'success'
                            ).then(result => {
                                parentFormGroup.remove();
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
    })

    $('input[type=radio]').on('click', function () {
        var parentFormGroup = $(this).parent().parent().parent().parent().parent();
        parentFormGroup.find('input[type=radio]').prop('checked', false);
        $(this).prop('checked', true);
    });
</script>
@endsection
