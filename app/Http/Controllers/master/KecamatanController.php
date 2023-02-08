<?php

namespace App\Http\Controllers\master;

use App\Http\Controllers\Controller;
use App\Models\Kecamatan;
use Illuminate\Http\Request;

class KecamatanController extends Controller
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
            'nama' => 'required|unique:kecamatans',
            'koordinat' => 'required',
            'kabupaten_id' => 'required',
        ]);
        $request['koordinat'] = json_encode($request['koordinat']);
        Kecamatan::create($request->all());
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
    public function update(Request $request, Kecamatan $kecamatan)
    {
        $request->validate([
            'nama' => 'required',
            'kabupaten_id' => 'required',
            'koordinat' => 'required',
        ]);

        $nama = $request->nama != $kecamatan->nama;
        if ($nama) {
            $request->validate([
                'nama' => 'required|unique:kecamatans'
            ]);
        }
        $kecamatan['koordinat'] = json_encode($request->koordinat);
        $kecamatan->nama = $request->nama;
        $kecamatan->kabupaten_id = $request->kabupaten_id;

        $kecamatan->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kecamatan $kecamatan)
    {
        $kecamatan->delete();
    }
}
