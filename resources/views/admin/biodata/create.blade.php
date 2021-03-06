<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Biodata</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      {!! Form::open(['url' => action('BiodataController@store'), 'method' => 'post', 'id' => 'submitForm', 'files' => true]) !!}  
      <div class="modal-body">
            <div class="row">
                <div class="col-md">
                    <div class="form-group">
                      {!! Form::label('name', 'Nama') !!}
                      {!! Form::text('name', null, 
                          ['class' => 'form-control', 'required', 'placeholder' => 'Ketik nama', 'required']); 
                      !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md">
                    <div class="form-group">
                      {!! Form::label('nomor', 'NIM/NIP') !!}
                      {!! Form::text('nomor', null, 
                          ['class' => 'form-control', 'required', 'placeholder' => 'Ketik NIM/NIP', 'required']); 
                      !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md">
                    <div class="form-group">
                      {!! Form::label('ttl', 'Tempat Tanggal Lahir') !!}
                      {!! Form::text('ttl', null, 
                          ['class' => 'form-control', 'required', 'placeholder' => 'Ketik Surabaya, 08 Agustus 2020', 'required']); 
                      !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md">
                    <div class="form-group">
                      {!! Form::label('type', 'Tipe Biodata') !!}
                      {!! Form::select('type', ['mahasiswa' => 'Mahasiswa', 'dosen' => 'Dosen'], null, 
                          ['class' => 'form-control type', 'required', 'placeholder' => 'Pilih Tipe Biodata', 'required']); 
                      !!}
                    </div>
                </div>
            </div>
            <div class="row d-none row_riwayat">
                <div class="col-md">
                  {!! Form::label('riwayat', 'Riwayat Pendidikan') !!}
                  <div class="input-group mb-2 mr-sm-2">
                      {!! Form::text('riwayat[]', null, 
                          ['id' => 'riwayat', 'class' => 'form-control', 'placeholder' => 'Ketik riwayat']); 
                      !!}
                      <div class="input-group-prepend increase_riwayat" style="cursor: pointer">
                        <div class="input-group-text">+</div>
                      </div>
                  </div>
                  <div class="riwayat_field"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md">
                    <div class="form-group">
                      {!! Form::label('image', 'Pilih Foto') !!}
                      {!! Form::file('image',
                          ['class' => 'form-control', 'placeholder' => 'Pilih Foto', 'required']); 
                      !!}
                    </div>
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <input type="submit" class="btn btn-primary" value="Simpan">
      </div>
    {!! Form::close() !!}
    </div>
</div>
<script>
  $('.type').on('change', function(e) {
    var value = $(this).val();
    if(value == 'dosen') {
      $('.row_riwayat').fadeIn(1000);
      $('.row_riwayat').removeClass('d-none');
    } else {
      $('.row_riwayat').fadeOut(1000);
      setTimeout(function() {
        $('.row_riwayat').addClass('d-none');
      }, 1000);
    }
  })
  $(document).on('click', '.increase_riwayat', function (e) {
      e.preventDefault();
      var html = '<div class="input-group mb-2 mr-sm-2">'
      html += '{!! Form::text('riwayat[]', null, ['id' => 'riwayat', 'class' => 'form-control', 'placeholder' => 'Ketik riwayat']); !!}'
      html += '<div class="input-group-prepend decrease_riwayat" style="cursor: pointer">' +
                  '<div class="input-group-text">-</div>' +
              '</div>'
      html += '</div>'
      $(".riwayat_field").append(html);
  });

  $(document).on('click', '.decrease_riwayat', function (e) {
      e.preventDefault();
      console.log($(this).parent().remove())
  });
</script>