<?php

namespace App\Http\Controllers\Admin;

use App\Deputy;
use App\Category;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Category::all();
        return view('admin.category.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $deputies = Deputy::all();
        return view('admin.category.create', compact('deputies'));
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

            Category::create($input);

            return redirect()->back()->with('response', [
                'status' => true,
                'message' => 'Berhasil menambahkan kategori'
            ]);
        } catch(\Exception $e) {
            return redirect()->back()->with('response', [
                'status' => false,
                'message' => 'Gagal menambahkan kategori'
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
        $category = Category::find($id);
        $deputies = Deputy::all();

        return view('admin.category.edit', compact(['category', 'deputies']));
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

            Category::find($id)->update($input);

            return redirect()->back()->with('response', [
                'status' => true,
                'message' => 'Berhasil update kategori'
            ]);
        } catch(\Exception $e) {
            return redirect()->back()->with('response', [
                'status' => false,
                'message' => 'Gagal update kategori'
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
            Category::find($id)->delete();

            return response()->json(['status' => true, 'message' => "Berhasil menghapus kategori"]);
        } catch(\Exception $e) {
            return response()->json(['status' => false, 'message' => "Gagal menghapus kategori"]);
        }
    }
}
