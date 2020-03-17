<div class="form-group">
    <div class="input-group mb-2 mr-sm-2">
        <div class="input-group-prepend" style="width: 50px">
            {!! Form::number('newsoal['.$count_soal.'][nomor]', $count_last_soal, 
                ['class' => 'form-control', 'required', 'required']); 
            !!}
        </div>
        {!! Form::text('newsoal['.$count_soal.'][soal]', null, 
            ['id' => 'soal', 'class' => 'form-control', 'required', 'placeholder' => 'Ketik Soal', 'required']); 
        !!}
        <a type="button" href="#" data-is_old="true" class="btn btn-danger ml-1 decrease_soal"><i class="fa fa-times"></i></a>
    </div>
    <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm">
            <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                <div class="input-group-text">A.</div>
                </div>
                {!! Form::text('newsoal['.$count_soal.'][pilihan][0][name]', null, 
                    ['id' => 'soal', 'class' => 'form-control', 'required', 'placeholder' => 'Ketik Pilihan', 'required']); 
                !!}
                <div class="ml-3 mt-2">
                    <input type="radio" id="soal_{{$count_soal}}_pilihan_is_jawaban_{{$count_soal+1}}" name="newsoal[{{$count_soal}}][pilihan][0][is_jawaban]" value="true">
                    <label for="soal_{{$count_soal}}_pilihan_is_jawaban_{{$count_soal+1}}">Kunci Jawaban?</label>
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
                {!! Form::text('newsoal['.$count_soal.'][pilihan][1][name]', null, 
                    ['id' => 'soal', 'class' => 'form-control', 'required', 'placeholder' => 'Ketik Pilihan', 'required']); 
                !!}
                <div class="ml-3 mt-2">
                    <input type="radio" id="soal_{{$count_soal}}_pilihan_is_jawaban_{{$count_soal+2}}" name="newsoal[{{$count_soal}}][pilihan][1][is_jawaban]" value="true">
                    <label for="soal_{{$count_soal}}_pilihan_is_jawaban_{{$count_soal+2}}">Kunci Jawaban?</label>
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
                {!! Form::text('newsoal['.$count_soal.'][pilihan][2][name]', null, 
                    ['id' => 'soal', 'class' => 'form-control', 'required', 'placeholder' => 'Ketik Pilihan', 'required']); 
                !!}
                <div class="ml-3 mt-2">
                    <input type="radio" id="soal_{{$count_soal}}_pilihan_is_jawaban_{{$count_soal+3}}" name="newsoal[{{$count_soal}}][pilihan][2][is_jawaban]" value="true">
                    <label for="soal_{{$count_soal}}_pilihan_is_jawaban_{{$count_soal+3}}">Kunci Jawaban?</label>
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
                {!! Form::text('newsoal['.$count_soal.'][pilihan][3][name]', null, 
                    ['id' => 'soal', 'class' => 'form-control', 'required', 'placeholder' => 'Ketik Pilihan', 'required']); 
                !!}
                <div class="ml-3 mt-2">
                    <input type="radio" id="soal_{{$count_soal}}_pilihan_is_jawaban_{{$count_soal+4}}" name="newsoal[{{$count_soal}}][pilihan][3][is_jawaban]" value="true">
                    <label for="soal_{{$count_soal}}_pilihan_is_jawaban_{{$count_soal+4}}">Kunci Jawaban?</label>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('input[type=radio]').on('click', function () {
        var parentFormGroup = $(this).parent().parent().parent().parent().parent();
        parentFormGroup.find('input[type=radio]').prop('checked', false);
        $(this).prop('checked', true);
    });

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
                Swal.fire(
                    'Berhasil!',
                    result.message,
                    'success'
                ).then(result => {
                    parentFormGroup.remove();
                })
            }
        })
    })
</script>