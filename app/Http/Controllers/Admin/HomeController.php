<?php

namespace App\Http\Controllers\Admin;

use App\Letter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $counts = (object)[
            'all' => Letter::count(),
            'in' => Letter::where('jenis_surat', 'masuk')->count(),
            'out' => Letter::where('jenis_surat', 'keluar')->count(),
        ];
        return view('home', compact('counts'));
    }
}
