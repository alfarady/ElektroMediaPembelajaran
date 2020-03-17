@extends('layouts.backend')
@section('content')

<div class="card">
    <div class="card-header">
        Semua Soal Materi {{ $materi->name }}
        <button
            class="btn btn-primary float-right increase_soal"><i class="fa fa-plus"></i> {{ __('Tambah Soal') }}</button>
    </div>

    {!! Form::open(['url' => action('SoalController@store'), 'method' => 'post', 'id' => 'submitForm']) !!}

    {!! Form::hidden('materi_id', $materi->id) !!}
        
    <div class="card-body soal_container">
        @foreach ($data as $key => $item)
            <div class="form-group">
                <div class="input-group mb-2 mr-sm-2">
                    <div class="input-group-prepend" style="width: 50px">
                        {!! Form::number('soal['.$item->id.'][nomor]', $item->nomor, 
                            ['class' => 'form-control', 'required', 'required']); 
                        !!}
                    </div>
                    {!! Form::text('soal['.$item->id.'][soal]', $item->soal, 
                        ['id' => 'soal', 'class' => 'form-control', 'required', 'placeholder' => 'Ketik Soal', 'required']); 
                    !!}
                    <a type="button" href="{{ action('SoalController@destroy', $item->id) }}" data-is_old="true" class="btn btn-danger ml-1 decrease_soal"><i class="fa fa-times"></i></a>
                </div>
                <div class="row">
                    <div class="col-sm-1">
                    </div>
                    <div class="col-sm">
                        <div class="input-group mb-2 mr-sm-2">
                            <div class="input-group-prepend">
                            <div class="input-group-text">A.</div>
                            </div>
                            {!! Form::text('soal['.$item->id.'][pilihan]['.$item->pilihan[0]->id.'][name]', $item->pilihan[0]->pilihan, 
                                ['id' => 'soal', 'class' => 'form-control', 'required', 'placeholder' => 'Ketik Pilihan', 'required']); 
                            !!}
                            <div class="ml-3 mt-2">
                                <input type="radio" id="soal_pilihan_is_jawaban_{{$item->pilihan[0]->id}}" name="soal[{{$item->id}}][pilihan][{{$item->pilihan[0]->id}}][is_jawaban]" value="true"
                                    @if ($item->pilihan[0]->is_jawaban)
                                        checked="checked"
                                    @endif>
                                <label for="soal_pilihan_is_jawaban_{{$item->pilihan[0]->id}}">Kunci Jawaban?</label>
                            </div>
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
                            {!! Form::text('soal['.$item->id.'][pilihan]['.$item->pilihan[1]->id.'][name]', $item->pilihan[1]->pilihan, 
                                ['id' => 'soal', 'class' => 'form-control', 'required', 'placeholder' => 'Ketik Pilihan', 'required']); 
                            !!}
                            <div class="ml-3 mt-2">
                                <input type="radio" id="soal_pilihan_is_jawaban_{{$item->pilihan[1]->id}}" name="soal[{{$item->id}}][pilihan][{{$item->pilihan[1]->id}}][is_jawaban]" value="true"
                                    @if ($item->pilihan[1]->is_jawaban)
                                        checked="checked"
                                    @endif>
                                <label for="soal_pilihan_is_jawaban_{{$item->pilihan[1]->id}}">Kunci Jawaban?</label>
                            </div>
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
                            {!! Form::text('soal['.$item->id.'][pilihan]['.$item->pilihan[2]->id.'][name]', $item->pilihan[2]->pilihan, 
                                ['id' => 'soal', 'class' => 'form-control', 'required', 'placeholder' => 'Ketik Pilihan', 'required']); 
                            !!}
                            <div class="ml-3 mt-2">
                                <input type="radio" id="soal_pilihan_is_jawaban_{{$item->pilihan[2]->id}}" name="soal[{{$item->id}}][pilihan][{{$item->pilihan[2]->id}}][is_jawaban]" value="true"
                                    @if ($item->pilihan[2]->is_jawaban)
                                        checked="checked"
                                    @endif>
                                <label for="soal_pilihan_is_jawaban_{{$item->pilihan[2]->id}}">Kunci Jawaban?</label>
                            </div>
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
                            {!! Form::text('soal['.$item->id.'][pilihan]['.$item->pilihan[3]->id.'][name]', $item->pilihan[3]->pilihan, 
                                ['id' => 'soal', 'class' => 'form-control', 'required', 'placeholder' => 'Ketik Pilihan', 'required']); 
                            !!}
                            <div class="ml-3 mt-2">
                                <input type="radio" id="soal_pilihan_is_jawaban_{{$item->pilihan[3]->id}}" name="soal[{{$item->id}}][pilihan][{{$item->pilihan[3]->id}}][is_jawaban]" value="true"
                                    @if ($item->pilihan[3]->is_jawaban)
                                        checked="checked"
                                    @endif>
                                <label for="soal_pilihan_is_jawaban_{{$item->pilihan[3]->id}}">Kunci Jawaban?</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach        
    </div>

    <div class="card-footer">
        <button type="submit" class="btn btn-success float-right">
            <i class="fa fa-check"></i> Simpan
        </button>
    </div>

    {!! Form::close() !!}
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
