<?php

namespace App\Http\Controllers;

use App\Biodata;

use Illuminate\Http\Request;

class BiodataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Biodata::all();
        return view('admin.biodata.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.biodata.create');
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
            
            if($request->hasFile('image')) {
                $name = time().'.'.$request->image->getClientOriginalExtension();
                $path = $request->image->move(public_path('uploads/images'), $name);
                $input['image'] = $name;
            } else {
                $input['image'] = '';
            }

            Biodata::create($input);

            flash('Berhasil menambah biodata')->success();

            return redirect()->route('biodata.index');
        } catch (\Exception $e) {
            flash('Gagal menambah biodata')->error();
            return redirect()->route('biodata.index');
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
        $data = Biodata::find($id);
        return view('admin.biodata.edit', compact('data'));
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
            
            if($request->hasFile('image')) {
                $name = time().'.'.$request->image->getClientOriginalExtension();
                $path = $request->image->move(public_path('uploads/images'), $name);
                $input['image'] = $name;
            } else {
                unset($input['image']);
            }

            Biodata::find($id)->update($input);

            flash('Berhasil merubah biodata')->success();

            return redirect()->route('biodata.index');
        } catch (\Exception $e) {
            flash('Gagal merubah biodata')->error();
            return redirect()->route('biodata.index');
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
        $materi = Biodata::findOrFail($id);
        $materi->delete();

        return response()->json([
            'status' => true,
            'message' => 'Berhasil menghapus biodata'
        ]);
    }
}
