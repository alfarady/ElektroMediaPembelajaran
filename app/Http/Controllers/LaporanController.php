<?php

namespace App\Http\Controllers;

use App\User;
use App\Materi;
use App\Jawaban;
use App\Pilihan;
use DB;

use Illuminate\Http\Request;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Materi::all();
        return view('admin.laporan.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $materi = Materi::find($id);
        $data = User::leftJoin('jawabans', 'users.id', '=', 'jawabans.user_id')
                    ->leftJoin('kelas', 'users.kelas_id', '=', 'kelas.id')
                    ->where('materi_id', $id)
                    ->select([
                        'users.id',
                        'users.name',
                        'kelas.name as kelas',
                        'materi_id',
                        DB::raw('COUNT(jawabans.id) as jumlah_soal'),
                        DB::raw("(SELECT COUNT(jawabans.id) FROM jawabans WHERE jawabans.is_true = 1 AND user_id = users.id AND materi_id = jawabans.materi_id) as jumlah_benar"),
                        DB::raw("(SELECT COUNT(jawabans.id) FROM jawabans WHERE jawabans.is_true = 0 AND user_id = users.id AND materi_id = jawabans.materi_id) as jumlah_salah"),
                        DB::raw("(ROUND(((100/(COUNT(jawabans.id)))*(SELECT COUNT(jawabans.id) FROM jawabans WHERE jawabans.is_true = 1 AND user_id = users.id AND materi_id = jawabans.materi_id)), 2)) as nilai")
                    ])
                    ->groupBy('users.id')
                    ->get();

        return view('admin.laporan.show', compact('data', 'materi'));
    }

    public function getJawaban($id, $user_id)
    {
        $user = User::leftJoin('jawabans', 'users.id', '=', 'jawabans.user_id')
                    ->where('materi_id', $id)
                    ->where('jawabans.user_id', $user_id)
                    ->select([
                        'users.id',
                        'users.name',
                        'materi_id',
                        DB::raw('COUNT(jawabans.id) as jumlah_soal'),
                        DB::raw("(SELECT COUNT(jawabans.id) FROM jawabans WHERE jawabans.is_true = 1 AND user_id = users.id AND materi_id = jawabans.materi_id) as jumlah_benar"),
                        DB::raw("(SELECT COUNT(jawabans.id) FROM jawabans WHERE jawabans.is_true = 0 AND user_id = users.id AND materi_id = jawabans.materi_id) as jumlah_salah"),
                        DB::raw("(ROUND(((100/(COUNT(jawabans.id)))*(SELECT COUNT(jawabans.id) FROM jawabans WHERE jawabans.is_true = 1 AND user_id = users.id AND materi_id = jawabans.materi_id)), 2)) as nilai")
                    ])
                    ->groupBy('users.id')
                    ->first();

        $data = Jawaban::join('soals', 'jawabans.soal_id', '=', 'soals.id')
                        ->where('user_id', $user_id)
                        ->where('jawabans.materi_id', $id)
                        ->orderBy('soals.nomor')
                        ->get();

        foreach($data as $key => $value) {
            $data[$key]->pilihan = Pilihan::where('soal_id', $value->soal_id)->get();
        }
        
        return view('admin.laporan.jawaban', compact('data', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
