<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function respondArray($eloquent, $is_paginated = true)
    {
        if($is_paginated) {
            $start = 0;
            $limit = request()->input('limit') ? request()->input('limit') : 20;
            $paged = request()->input('page') ? request()->input('page') : 1;
    
            $start = ($paged - 1) * $limit; 
            $eloquent = $eloquent->offset($start)->limit($limit)->get();
        }

        return response()->json($eloquent);
    }

    protected function respondSuccess($msg, $arr = null)
    {
        $res = [
            'status' => true,
            'message' => ($msg == "") ? "Data diterima" : $msg,
        ];
        
        if($arr) {
            $res['data'] = $arr;
        }

        return response()->json($res);
    }

    protected function respondFailed($msg, $arr = null)
    {
        $res = [
            'status' => false,
            'message' => ($msg == "") ? "Gagal memproses" : $msg,
        ];
        
        if($arr) {
            $res['data'] = $arr;
        }

        return response()->json($res, 500);
    }
}
