<?php

namespace App\Http\Controllers;

use App\Materi;

use Illuminate\Http\Request;

class MateriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Materi::all();
        return view('admin.materi.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.materi.create');
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
            $input = $request->only(['name', 'indikator']);
            
            if($request->hasFile('materi_file')) {
                $name = time().'.'.$request->materi_file->getClientOriginalExtension();
                // $path = $request->materi_file->move(public_path('uploads/materi'), $name);
                // dd($path);
                $materi = $this->readDocx('F:\Other Projects\ElektroMediaPembelajaran\public\uploads/materi\1584351273.docx');
                $input['materi'] = $materi;
            } else {
                $input['materi'] = $request->materi;
            }

            Materi::create($input);

            flash('Berhasil menambah materi')->success();

            return redirect()->route('materi.index');
        } catch (\Exception $e) {
            flash('Gagal menambah materi')->error();
            return redirect()->route('materi.index');
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
        $data = Materi::find($id);
        return view('admin.materi.edit', compact('data'));
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
        try {
            $input = $request->only(['name', 'materi', 'indikator']);

            Materi::find($id)->update($input);

            flash('Berhasil merubah materi')->success();

            return redirect()->route('materi.index');
        } catch (\Exception $e) {
            flash('Gagal merubah materi')->error();
            return redirect()->route('materi.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $materi = Materi::findOrFail($id);
        $materi->delete();

        return response()->json([
            'status' => true,
            'message' => 'Berhasil menghapus materi'
        ]);
    }

    private function readDocx($filePath) {
        $phpWord = \PhpOffice\PhpWord\IOFactory::load($filePath);
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'HTML');
        $name = time().'.html';
        $objWriter->save($name);

        return file_get_contents($name);
    }
}
