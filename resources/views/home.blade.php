@extends('layouts.backend')

@section('content')
    <!-- Page Content -->
    <div class="content" style="background: #d8d8d8;">
    <!-- END Page Content -->
    <div class="row invisible" data-toggle="appear">
    <!-- Row #1 -->
    <div class="col-6 col-xl-4">
        <a class="block block-link-shadow text-right" href="javascript:void(0)">
            <div class="block-content block-content-full clearfix">
                <div class="float-left mt-10 d-none d-sm-block">
                    <i class="si si-users fa-3x text-body-bg-dark"></i>
                </div>
                <div class="font-size-h3 font-w600" data-toggle="countTo" data-speed="1000" data-to="0">0</div>
                <div class="font-size-sm font-w600 text-uppercase text-muted">Jumlah Semua Surat</div>
            </div>
        </a>
    </div>
    <div class="col-6 col-xl-4">
        <a class="block block-link-shadow text-right" href="javascript:void(0)">
            <div class="block-content block-content-full clearfix">
                <div class="float-left mt-10 d-none d-sm-block">
                    <i class="si si-users fa-3x text-body-bg-dark"></i>
                </div>
                <div class="font-size-h3 font-w600"><span data-toggle="countTo" data-speed="1000" data-to="0">0</span></div>
                <div class="font-size-sm font-w600 text-uppercase text-muted">Surat Masuk</div>
            </div>
        </a>
    </div>
    <div class="col-6 col-xl-4">
        <a class="block block-link-shadow text-right" href="javascript:void(0)">
            <div class="block-content block-content-full clearfix">
                <div class="float-left mt-10 d-none d-sm-block">
                    <i class="si si-users fa-3x text-body-bg-dark"></i>
                </div>
                <div class="font-size-h3 font-w600" data-toggle="countTo" data-speed="1000" data-to="0">0</div>
                <div class="font-size-sm font-w600 text-uppercase text-muted">Surat Keluar</div>
            </div>
        </a>
    </div>
    <!-- END Row #1 -->
    
    </div>
</div>
@endsection
