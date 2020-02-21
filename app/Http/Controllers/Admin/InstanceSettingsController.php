<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Letter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InstanceSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();

        return view('admin.instance_setting.index', compact('user'));
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
        try {
            $input = $request->all();

            auth()->user()->update($input);

            return redirect()->route('admin.instance-settings.index')->with('response', [
                'status' => true,
                'message' => 'Berhasil update instansi'
            ]);
        } catch(\Exception $e) {
            return redirect()->route('admin.instance-settings.index')->with('response', [
                'status' => false,
                'message' => 'Gagal update instansi'
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
            auth()->user()->update(['total_outbox' => 0]);
            Letter::get()
                ->map(function($q) {
                    $q->delete();
                });

            return response()->json(['status' => true, 'message' => "Berhasil menutup buku tahunan"]);
        } catch(\Exception $e) {
            dd($e);
            return response()->json(['status' => false, 'message' => "Gagal menutup buku tahunan"]);
        }
    }
}
