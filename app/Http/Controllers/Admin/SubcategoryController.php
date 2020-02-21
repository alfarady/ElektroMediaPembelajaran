<?php

namespace App\Http\Controllers\Admin;

use App\Deputy;
use App\Category;
use App\SubCategory;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = SubCategory::all();
        return view('admin.subcategory.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.subcategory.create', compact('categories'));
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
            // $validatedData = $request->validate([
            //     'index' => 'required|unique:sub_categories',
            // ]);

            $input = $request->all();
            
            $isExistIndex = SubCategory::where([
                'category_id' => $input['category_id'],
                'index' => $input['index']
            ])->first();

            if(!$isExistIndex)
                SubCategory::create($input);
            else
                throw new \Exception();

            return redirect()->back()->with('response', [
                'status' => true,
                'message' => 'Berhasil menambahkan sub kategori'
            ]);
        } catch(\Exception $e) {
            return redirect()->back()->with('response', [
                'status' => false,
                'message' => 'Gagal menambahkan sub kategori'
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
        $subcategory = SubCategory::find($id);
        $categories = Category::all();

        return view('admin.subcategory.edit', compact(['subcategory', 'categories']));
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

            $isExistIndex = SubCategory::where([
                'category_id' => $input['category_id'],
                'index' => $input['index'],
            ])->first();

            if($isExistIndex){
                if($isExistIndex->id == $id)
                    SubCategory::find($id)->update($input);
                else
                    throw new \Exception();
            } else
                throw new \Exception();

            return redirect()->back()->with('response', [
                'status' => true,
                'message' => 'Berhasil update sub kategori'
            ]);
        } catch(\Exception $e) {
            return redirect()->back()->with('response', [
                'status' => false,
                'message' => 'Gagal update sub kategori'
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
            SubCategory::find($id)->delete();

            return response()->json(['status' => true, 'message' => "Berhasil menghapus sub kategori"]);
        } catch(\Exception $e) {
            return response()->json(['status' => false, 'message' => "Gagal menghapus sub kategori"]);
        }
    }
}
