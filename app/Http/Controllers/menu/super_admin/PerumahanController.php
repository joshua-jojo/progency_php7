<?php

namespace App\Http\Controllers\menu\super_admin;

use App\Http\Controllers\Controller;
use App\Models\Perumahan;
use Illuminate\Http\Request;

class PerumahanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cari = $request->cari ?: '';
        $perumahan = Perumahan::with('developer.user')
            ->where('nama', 'like', "%{$cari}%")
            ->orWhereHas('developer.user', function ($q) use ($cari) {
                $q->where('nama', 'like', "%$cari%");
            })
            ->orderBy('id', 'desc')
            ->paginate(10)
            ->withQueryString();
        return inertia()->render('menu/super_admin/data_perumahan', compact('perumahan', 'cari'));
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
