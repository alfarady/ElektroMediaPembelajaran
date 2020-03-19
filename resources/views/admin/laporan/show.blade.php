@extends('layouts.backend')
@section('content')

<div class="card">
    <div class="card-header">
        Nilai Siswa Materi {{$materi->name}}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            Nama
                        </th>
                        <th>
                            Kelas
                        </th>
                        <th>
                            Jumlah Soal
                        </th>
                        <th>
                            Jumlah Benar
                        </th>
                        <th>
                            Jumlah Salah
                        </th>
                        <th>
                            Nilai
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $key => $user)
                        <tr data-entry-id="{{ $user->id }}">
                            <td>
                                
                            </td>
                            <td>
                                {{ $user->name ?? '' }}
                            </td>
                            <td>
                                {{ $user->kelas ?? '' }}
                            </td>
                            <td>
                                {{ $user->jumlah_soal ?? '' }}
                            </td>
                            <td>
                                {{ $user->jumlah_benar ?? '' }}
                            </td>
                            <td>
                                {{ $user->jumlah_salah ?? '' }}
                            </td>
                            <td>
                                <span class="badge badge-info">{{ $user->nilai }}</span>
                            </td>
                            <td>
                                <a class="btn btn-info btn-sm" href="{{ action('LaporanController@getJawaban', [$user->materi_id, $user->id]) }}">
                                    Lihat Jawaban
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('js_after')
@parent
<script>
    $(function () {
        $('.datatable:not(.ajaxTable)').DataTable()
    });
</script>
@endsection