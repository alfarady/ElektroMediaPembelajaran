<?php

namespace App\Http\Controllers\Api;

use App\Jawaban;
use App\Soal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JawabanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        try {
            $ljk = $request->input(['ljk']);

            $input = [];
            foreach($ljk as $key => $value) {
                $temp['user_id'] = auth()->user()->id;
                $temp['soal_id'] = $value['soal_id'];
                $temp['materi_id'] = Soal::find($temp['soal_id'])->materi_id;
                $temp['pilihan_id'] = $value['pilihan_id'];
                $temp['is_true'] = $value['is_true'];
                $temp['jawaban'] = $value['jawaban'];
                $temp['created_at'] = date('Y-m-d H:i:s');
                $temp['updated_at'] = date('Y-m-d H:i:s');
                $input[] = $temp;
            }

            Jawaban::insert($input);

            return $this->respondSuccess('Berhasil menyimpan jawaban');
        } catch(\Exception $e) {
            return $this->respondFailed('Gagal menyimpan jawaban');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
