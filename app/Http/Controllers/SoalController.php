<?php

namespace App\Http\Controllers;

use App\Materi;
use App\Soal;
use App\Pilihan;

use DB;
use Illuminate\Http\Request;

class SoalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Materi::all();
        return view('admin.soal.main', compact('data'));
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

            $input = $request->only(['materi_id']);

            $update_soal = $request->input('soal');
            $new_soal = $request->input('newsoal');

            DB::beginTransaction();

            // Update existing soal
            if($update_soal) {
                foreach($update_soal as $soal_id => $soal_data) {
                    $soal = Soal::findOrFail($soal_id);
                    $soal->materi_id = $input['materi_id'];
                    $soal->nomor = $soal_data['nomor'];
                    $soal->soal = $soal_data['soal'];
                    $soal->save();

                    foreach($soal_data['pilihan'] as $pilihan_id => $pilihan_data) {
                        $pilihan = Pilihan::findOrFail($pilihan_id);
                        $pilihan->soal_id = $soal_id;
                        $pilihan->pilihan = $pilihan_data['name'];

                        if(array_key_exists('is_jawaban', $pilihan_data)) {
                            $pilihan->is_jawaban = 1;
                        } else {
                            $pilihan->is_jawaban = 0;
                        }

                        $pilihan->save();
                    }
                }
            }

            // Add new soal
            if($new_soal) {
                foreach($new_soal as $key => $soal_data) {
                    $input['nomor'] = $soal_data['nomor'];
                    $input['soal'] = $soal_data['soal'];
                    
                    $soal = Soal::create($input);
    
                    foreach($soal_data['pilihan'] as $key => $pilihan_data) {
                        $input_pilihan['soal_id'] = $soal->id;
                        $input_pilihan['pilihan'] = $pilihan_data['name'];
    
                        if(array_key_exists('is_jawaban', $pilihan_data)) {
                            $input_pilihan['is_jawaban'] = 1;
                        } else {
                            $input_pilihan['is_jawaban'] = 0;
                        }
    
                        $pilihan = Pilihan::create($input_pilihan);
                    }
                }
            }

            DB::commit();
            
            flash('Berhasil menambah soal')->success();

            return back();
        } catch(\Exception $e) {
            DB::rollBack();

            dd($e);
            
            flash('Gagal menambah soal')->error();

            return back();
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
        $soal = Soal::findOrFail($id);
        $soal->delete();

        return response()->json([
            'status' => true,
            'message' => 'Berhasil menghapus soal'
        ]);
    }

    public function getSoalForm() {
        $count_soal = request()->count ?? 1;
        $count_last_soal = request()->count ?? 1;
        return view('admin.soal.partials.soal', compact('count_soal', 'count_last_soal'));
    }
}
