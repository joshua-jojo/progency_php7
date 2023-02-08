<?php

namespace App\Http\Controllers\pendataan;

use App\Http\Controllers\Controller;
use App\Models\Developer;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Perumahan;
use Illuminate\Http\Request;

class MapPerumahanController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Perumahan  $perumahan
     * @return \Illuminate\Http\Response
     */
    public function show(Perumahan $perumahan)
    {
        $perumahan->load('developer_perumahan');
        $perumahan->koordinat = json_decode($perumahan->developer_perumahan->mark);
        $perumahan->polygon = json_decode($perumahan->developer_perumahan->polygon);
        $perumahan->cover = asset($perumahan->cover);
        return inertia()->render('data_perumahan/maps', compact('perumahan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Perumahan  $perumahan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Perumahan $perumahan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Perumahan  $perumahan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Perumahan $perumahan)
    {
        //
    }
}
