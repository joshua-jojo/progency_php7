<?php

namespace App\Http\Controllers\master;

use App\Http\Controllers\Controller;
use App\Models\Kabupaten;
use Illuminate\Http\Request;

class KabupatenController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|unique:kabupatens',
            'koordinat' => 'required',
        ]);
        $request['koordinat'] = json_encode($request['koordinat']);
        Kabupaten::create($request->only(['nama', 'koordinat']));
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kabupaten $kabupaten)
    {
        $request->validate([
            'nama' => 'required',
            'koordinat' => 'required',
        ]);

        $nama = $request->nama != $kabupaten->nama;
        if ($nama) {
            $request->validate([
                'nama' => 'unique:kabupatens'
            ]);
        }

        $kabupaten->nama = $request->nama;
        $kabupaten->koordinat = json_encode($request->koordinat);
        $kabupaten->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kabupaten $kabupaten)
    {
        $kabupaten->kecamatan()->delete();
        $kabupaten->delete();
    }
}
