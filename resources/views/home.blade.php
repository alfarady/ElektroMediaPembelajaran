@extends('layouts.backend')

@section('content')
    <!-- Page Content -->
    <div class="content" style="background: #d8d8d8;">
    <!-- END Page Content -->
    <div class="row invisible" data-toggle="appear">
        <!-- Row #1 -->
        <div class="col-6 col-xl-6">
            <a class="block block-link-shadow text-right" href="javascript:void(0)">
                <div class="block-content block-content-full clearfix">
                    <div class="float-left mt-10 d-none d-sm-block">
                        <i class="si si-users fa-3x text-primary"></i>
                    </div>
                    <div class="font-size-h3 font-w600" data-toggle="countTo" data-speed="1000" data-to="{{$user_count}}">0</div>
                    <div class="font-size-sm font-w600 text-uppercase text-muted">Jumlah Siswa</div>
                </div>
            </a>
        </div>
        <div class="col-6 col-xl-6">
            <a class="block block-link-shadow text-right" href="javascript:void(0)">
                <div class="block-content block-content-full clearfix">
                    <div class="float-left mt-10 d-none d-sm-block">
                        <i class="fa fa-book fa-3x text-primary"></i>
                    </div>
                    <div class="font-size-h3 font-w600"><span data-toggle="countTo" data-speed="1000" data-to="{{$materi_count}}">0</span></div>
                    <div class="font-size-sm font-w600 text-uppercase text-muted">Jumlah Materi</div>
                </div>
            </a>
        </div>
        <!-- END Row #1 -->
    </div>
    <div class="row invisible" data-toggle="appear">
        <div class="col-md">
            <div class="block block-rounded block-bordered">
                <div class="block-header block-header-default border-b">
                    <h3 class="block-title">Daftar Siswa</h3>
                </div>
                <div class="block-content">
                    <table class="table table-borderless table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Kelas</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($siswa as $key => $value)
                            <tr>
                                <td>{{ $value->name ?? '' }}</td>
                                <td>{{ $value->kelas->name ?? ''}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
