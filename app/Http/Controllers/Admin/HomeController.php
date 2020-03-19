<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Materi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $user_count = User::where('id', '!=', auth()->user()->id)->count();
        $materi_count = Materi::count();
        $siswa = User::where('id', '!=', auth()->user()->id)->take(10)->orderBy('created_at', 'desc')->get();
        return view('home', compact('user_count', 'materi_count', 'siswa'));
    }
}
