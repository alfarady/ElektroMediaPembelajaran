<?php

namespace App\Http\Controllers\Admin;

use App\Letter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        if(auth()->user()->hasRole('Admin'))
            $letter = new Letter;
        else $letter = Letter::where('created_by', auth()->user()->id);

        $all = $letter->count();
        $in = $letter->where('jenis_surat', 'masuk')->count();
        $out = $letter->where('jenis_surat', 'keluar')->count();
        $archive = $letter->onlyTrashed()->count();

        $counts = (object)[
            'all' => $all,
            'in' => $in,
            'out' => $out,
            'archive' => $archive,
        ];
        return view('home', compact('counts'));
    }
}
