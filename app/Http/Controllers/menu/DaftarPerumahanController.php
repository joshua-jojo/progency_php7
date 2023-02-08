<?php

namespace App\Http\Controllers\menu;

use App\Http\Controllers\Controller;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Perumahan;
use Illuminate\Http\Request;

class DaftarPerumahanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = auth()->user()->can('agen', Perumahan::class);
        if (!$user) {
            abort(403, 'akses tidak diizinkan. akun harus agen aktif');
        }

        $search = [
            'cari' => $request->cari ?: null,
            'urutkan' => $request->urutkan ?: 'apapun',
            'kondisi' => $request->kondisi ?: 'apapun',
            'kamar_tidur' => $request->kamar_tidur ?: 1,
            'kamar_mandi' => $request->kamar_mandi ?: 1,
            'harga' => [
                'min' => $request->harga ? ($request->harga['min'] != null ? $request->harga['min'] : 0) : 0,
                'max' => $request->harga ? ($request->harga['max'] != null ? $request->harga['max'] : 0) : 0,
            ],
            'luas_tanah' => [
                'min' => $request->luas_tanah ? ($request->luas_tanah['min'] != null ? $request->luas_tanah['min'] : 0) : 0,
                'max' => $request->luas_tanah ? ($request->luas_tanah['max'] != null ? $request->luas_tanah['max'] : 0) : 0,
            ],
            'luas_bangunan' => [
                'min' => $request->luas_bangunan ? ($request->luas_bangunan['min'] != null ? $request->luas_bangunan['min'] : 0) : 0,
                'max' => $request->luas_bangunan ? ($request->luas_bangunan['max'] != null ? $request->luas_bangunan['max'] : 0) : 0,
            ],
        ];
        // ->orWhere('tipe', 'like', "%{$search['cari']}%")
        //             ->orWhere('alamat', 'like', "%{$search['cari']}%")
        //             ->orWhere('jenis', 'like', "{$search['cari']}%")

        $kabupaten = Kabupaten::all();
        $kecamatan = Kecamatan::all();
        $perumahan = Perumahan::with(['perumahan_detail', 'developer'])
            ->where('status', 'tersedia');

        switch ($search['urutkan']) {
            case 'terbaru':
                $perumahan->orderBy('id', 'desc');
                break;

            case 'harga tertinggi':
                $perumahan->orderBy('harga', 'desc');
                break;

            case 'harga terendah':
                $perumahan->orderBy('harga', 'asc');
                break;

            default:
                # code...
                break;
        }

        switch ($search['kondisi']) {
            case 'baru':
                $perumahan->where('kondisi', 'baru');
                break;

            case 'bekas':
                $perumahan->where('kondisi', 'bekas');
                break;

            default:
                # code...
                break;
        }

        if ($search['harga']['max'] > 0) {
            $perumahan->where('harga', '>=', $search['harga']['min'])
                ->where('harga', '<=', $search['harga']['max']);
        }

        $perumahan->whereHas('perumahan_detail', function ($detail) use ($search) {

            $detail->where('kamar_tidur', '>=', $search['kamar_tidur'])
                ->where('kamar_mandi', '>=', $search['kamar_mandi']);

            // $detail->where('luas_tanah', 'like', "%{$search['cari']}%")
            //     ->where('luas_bangunan', 'like', "%{$search['cari']}%");

            if ($search['luas_tanah']['max'] - $search['luas_tanah']['min'] > 0) {
                $detail->where('luas_tanah', '>=', $search['luas_tanah']['min'])
                    ->where('luas_tanah', '<=', $search['luas_tanah']['max']);
            }

            if ($search['luas_bangunan']['max'] - $search['luas_bangunan']['min'] > 0) {
                $detail->where('luas_bangunan', '>=', $search['luas_bangunan']['min'])
                    ->where('luas_bangunan', '<=', $search['luas_bangunan']['max']);
            }
        });
        $perumahan->where(function ($q) use ($search) {
            $q->where('nama', 'like', "%{$search['cari']}%");
            $q->orWhere('alamat', 'like', "%{$search['cari']}%");
        });
        $perumahan = $perumahan
            ->paginate(10)
            ->withQueryString();

        $perumahan->getCollection()->transform(function ($q) use ($kabupaten, $kecamatan) {
            $data_perumahan = $q;
            $data_perumahan->cover = asset($data_perumahan->cover);
            return $data_perumahan;
        });
        return inertia()->render('data_perumahan/data_perumahan', compact('perumahan', 'search'));
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
        $perumahan->load('perumahan_detail', 'booking');
        $perumahan->cover = asset($perumahan->cover);
        $perumahan->perumahan_detail->foto = collect(json_decode($perumahan->perumahan_detail->foto));
        $perumahan->perumahan_detail->foto->map(function ($q) {
            $q->file = asset($q->file);
            return $q;
        });
        return inertia()->render('data_perumahan/detail_perumahan', compact('perumahan'));
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
