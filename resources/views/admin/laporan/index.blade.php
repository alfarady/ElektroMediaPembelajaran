@extends('layouts.backend')
@section('content')

<div class="card">
    <div class="card-header">
        Laporan
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable">
                <thead>
                    <tr>
                        <th width="8">

                        </th>
                        <th>
                            Soal
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $key => $value)
                    <tr data-entry-id="{{ $value->id }}">
                        <td>
                            {{$key+1}}
                        </td>
                        <td>
                            Soal Materi {{$value->name}}
                        </td>
                        <td>
                            <a class="btn btn-info btn-sm" href="{{ route('laporan.show', $value->id) }}">
                                Lihat Nilai
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
