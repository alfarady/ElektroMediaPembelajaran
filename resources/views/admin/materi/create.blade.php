@extends('layouts.backend')
@section('content')

<div class="card">
    <div class="card-header">
        Tambah Materi
    </div>

    <div class="card-body">
        {!! Form::open(['url' => action('MateriController@store'), 'method' => 'post', 'id' => 'submitForm', 'files' => true]) !!}
        <div class="form-group">
            {!! Form::label('name', 'Judul Materi') !!}
            {!! Form::text('name', null, 
                ['class' => 'form-control', 'required', 'placeholder' => 'Ketik judul materi', 'required']); 
            !!}
        </div>
        {!! Form::label('indikator', 'Indikator') !!}
        <div class="input-group mb-2 mr-sm-2">
            {!! Form::text('indikator[]', null, 
                ['id' => 'indikator', 'class' => 'form-control', 'required', 'placeholder' => 'Ketik indikator', 'required']); 
            !!}
            <div class="input-group-prepend increase_indikator" style="cursor: pointer">
              <div class="input-group-text">+</div>
            </div>
        </div>
        <div class="indikator_field"></div>

        <div class="form-group">
            {!! Form::label('editor-container', 'Isi Materi') !!}
            {!! Form::hidden('materi', null, ['id' => 'materi']) !!}
            <div id="editor-container" class="mb-3" style="height:200px;">
        </div>

        <div class="form-group">
            {!! Form::label('editor-container', 'Atau Upload Materi') !!}
            {!! Form::file('materi_file', 
                ['class' => 'form-control', 'placeholder' => 'Pilih Docx']); 
            !!}
        </div>

        <button type="submit" class="btn btn-primary float-right">
            <i class="fa fa-check"></i> Tambah
        </button>

        {!! Form::close() !!}
    </div>
</div>

@endsection
@section('js_after')
@parent
<script>
$(document).on('click', '.increase_indikator', function (e) {
    e.preventDefault();
    var html = '<div class="input-group mb-2 mr-sm-2">'
    html += '{!! Form::text('indikator[]', null, ['id' => 'indikator', 'class' => 'form-control', 'required', 'placeholder' => 'Ketik indikator', 'required']); !!}'
    html += '<div class="input-group-prepend decrease_indikator" style="cursor: pointer">' +
                '<div class="input-group-text">-</div>' +
            '</div>'
    html += '</div>'
    $(".indikator_field").append(html);
});

$(document).on('click', '.decrease_indikator', function (e) {
    e.preventDefault();
    console.log($(this).parent().remove())
});
    
var quill = new Quill('#editor-container', {
    modules: {
        toolbar: [
        ['bold', 'italic'],
        ['link', 'blockquote', 'code-block', 'image'],
        [{ list: 'ordered' }, { list: 'bullet' }]
        ]
    },
    placeholder: 'Tuliskan sesuatu atau upload file',
    theme: 'snow'
});

$( document ).ready(function() {
    var form = document.getElementById('submitForm');
    if (form.attachEvent) {
        form.attachEvent("submit", processForm);
    } else {
        form.addEventListener("submit", processForm);
    }
});

function processForm(e) {
    if (e.preventDefault) e.preventDefault();

    var quillLength = quill.getLength();
        console.log(quillLength)
    if(quillLength > 1) {
        console.log(quill.root.innerHTML);
        document.getElementById('materi').value = quill.root.innerHTML;
    } else {
        $('#materi_file').prop('required', true);
        $('#submitForm')[0].checkValidity();
    }
    
    document.forms["submitForm"].submit();
    
    return false;
}
</script>
@endsection
