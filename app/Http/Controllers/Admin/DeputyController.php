<?php

namespace App\Http\Controllers\Admin;

use App\Deputy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DeputyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Deputy::all();
        return view('admin.deputy.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.deputy.create');
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
            $input = $request->all();

            Deputy::create($input);

            return redirect()->back()->with('response', [
                'status' => true,
                'message' => 'Berhasil menambahkan deputy'
            ]);
        } catch(\Exception $e) {
            return redirect()->back()->with('response', [
                'status' => false,
                'message' => 'Gagal menambahkan deputy'
            ]);
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
        $data = Deputy::find($id);
        return view('admin.deputy.edit', compact('data'));
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
            $input = $request->all();

            Deputy::find($id)->update($input);

            return redirect()->back()->with('response', [
                'status' => true,
                'message' => 'Berhasil update deputy'
            ]);
        } catch(\Exception $e) {
            return redirect()->back()->with('response', [
                'status' => false,
                'message' => 'Gagal update deputy'
            ]);
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
        try {
            Deputy::find($id)->delete();

            return response()->json(['status' => true, 'message' => "Berhasil menghapus deputy"]);
        } catch(\Exception $e) {
            return response()->json(['status' => false, 'message' => "Gagal menghapus deputy"]);
        }
    }
}
