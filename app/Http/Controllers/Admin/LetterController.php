<?php

namespace App\Http\Controllers\Admin;

use App\Deputy;
use App\Category;
use App\SubCategory;
use App\Letter;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LetterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Letter::all();
        return view('admin.letter.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $deputies = Deputy::all();
        return view('admin.letter.create', compact('deputies'));
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
            $input['created_by'] = auth()->user()->id;
            $date = \DateTime::createFromFormat('d/m/Y', $input['tanggal_surat']);
            $output = $date->format('Y-m-d');
            $input['tanggal_surat'] = date('Y-m-d', strtotime($output));

            Letter::create($input);

            return redirect()->route('admin.letters.index')->with('response', [
                'status' => true,
                'message' => 'Berhasil menambahkan surat'
            ]);
        } catch(\Exception $e) {
            return redirect()->route('admin.letters.index')->with('response', [
                'status' => false,
                'message' => 'Gagal menambahkan surat'
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
        $deputies = Deputy::all();
        $letter = Letter::find($id);
        return view('admin.letter.edit', compact(['deputies', 'letter']));
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
            $date = \DateTime::createFromFormat('d/m/Y', $input['tanggal_surat']);
            $output = $date->format('Y-m-d');
            $input['tanggal_surat'] = date('Y-m-d', strtotime($output));

            Letter::find($id)->update($input);

            return redirect()->route('admin.letters.index')->with('response', [
                'status' => true,
                'message' => 'Berhasil update surat'
            ]);
        } catch(\Exception $e) {
            return redirect()->route('admin.letters.index')->with('response', [
                'status' => false,
                'message' => 'Gagal update surat'
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
            Letter::find($id)->delete();

            return response()->json(['status' => true, 'message' => "Berhasil menghapus surat"]);
        } catch(\Exception $e) {
            return response()->json(['status' => false, 'message' => "Gagal menghapus surat"]);
        }
    }

    /*
        Format 1 = {counter} / {category} / {index sub category}
        Format 2 = {counter} / {bagian deputy} / {category} / {index sub category}
    */
    public function getRefNo($deputy_id, $category_id, $sub_category_id)
    {
        $counter = Letter::where('jenis_surat', 'keluar')->count() + 1;
        $bagian = Deputy::find($deputy_id)->name_bagian;
        $category = Category::find($category_id)->name;
        $index = SubCategory::find($sub_category_id)->index;

        $noref = '';
        $noref .= $counter;
        $noref .= '/';
        if($bagian) $noref .= $bagian.'/';
        $noref .= $category;
        $noref .= '/';
        $noref .= $index;
        return $noref;
    }

    public function getCat($id)
    {
        $cat = Category::where('deputy_id', $id)->get();
        return response()->json($cat);
    }

    public function getSubCat($id)
    {
        $cat = SubCategory::where('category_id', $id)->get();
        return response()->json($cat);
    }
}
