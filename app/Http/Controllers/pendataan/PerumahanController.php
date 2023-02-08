<?php

namespace App\Http\Controllers\pendataan;

use App\Http\Controllers\Controller;
use App\Http\Middleware\Developer;
use App\Models\Developer as AppDeveloper;
use App\Models\DeveloperPerumahan;
use App\Models\Perumahan;
use App\Rules\PerumahanRules;
use Illuminate\Http\Request;

class PerumahanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => ['required', new PerumahanRules],
            'cover' => ['required'],
            'developer_id' => ['required'],
            'developer_perumahan_id' => ['required'],
            'blok' => ['required'],
            "kondisi" => ['required'],
            "tipe" => ['required'],
            "jenis" => ['required'],
            "sertifikat" => ['required'],
            "harga" => ['required'],
            "deskripsi" => ['required'],
            'cluster' => 'required',
            'kamar_tidur' => 'required',
            'lantai' => 'required',
            'kamar_mandi' => 'required',
            'garasi' => 'required',
            'daya_listrik' => 'required',
            'kondisi_parabotan' => 'required',
            'tahun_dibangun' => 'required',
            'luas_tanah' => 'required',
            'luas_bangunan' => 'required',
            'fasilitas' => 'required',
            'foto_data.*.file' => 'required',
            'foto_data' => 'required',
        ]);
        $developer = AppDeveloper::find($request->developer_id);
        $developer_perumahan = DeveloperPerumahan::with(['provinsi', 'kabupaten', 'kecamatan', 'kota'])->find($request->developer_perumahan_id);
        $developer->load(['perumahan']);

        $data_perumahan = $request->only(['developer_perumahan_id', 'nama', 'tipe', 'blok', 'alamat', 'jenis', 'sertifikat', 'harga', 'deskripsi', 'kondisi', 'status', 'cover']);
        $data_perumahan['alamat'] = "{$developer_perumahan->kota->nama}, {$developer_perumahan->kecamatan->nama}, {$developer_perumahan->kabupaten->nama}, {$developer_perumahan->provinsi->nama}";
        $nama_cover = strtotime(date('Y-m-d H:i:s')) . '.' . $request->file('cover')->getClientOriginalExtension();
        $path = "img/perumahan_file";
        $request->file('cover')->move($path, $nama_cover);
        $path = "img/perumahan_file/$nama_cover";
        $data_perumahan['cover'] = $path;

        $perumahan = $developer->perumahan()->create($data_perumahan);
        $perumahan->kode = 'PR' . sprintf("%06s", $perumahan->id);
        $perumahan->update();

        $data_perumahan_detail = $request->only(['cluster', 'tahun_dibangun', 'kamar_tidur', 'lantai', 'kamar_mandi', 'luas_tanah', 'luas_bangunan', 'garasi', 'daya_listrik', 'tahun_bangun', 'fasilitas', 'kondisi_parabotan']);
        if ($request->hasFile('foto_data.*.file')) {
            $final_foto = $request->file('foto_data.*.file');
            $database_foto = [];

            foreach ($final_foto as $key => $value) {
                $nama = strtotime(date('Y-m-d H:i:s')) . $key . '.' . $value->getClientOriginalExtension();
                $path = "img/perumahan_file/";
                $value->move($path, $nama);
                $path_database = $path . $nama;
                $database_foto[] = [
                    'id' => $key,
                    'name' => $nama,
                    'file' => $path_database
                ];
            }
            $database_foto = json_encode($database_foto);
            $data_perumahan_detail['foto'] = $database_foto;
        }
        $perumahan->perumahan_detail()->create($data_perumahan_detail);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($perumahan)
    {
        $hak_akses = !auth()->user()->can('developer', Developer::class);
        if ($hak_akses) {
            return abort(403, "hanya developer aktif yang dapat akses.");
        }

        $developer = AppDeveloper::find($perumahan)->load(['perumahan' => function ($q) {
            $q->orderBy('id', 'desc');
        }, 'perumahan.perumahan_detail', 'perumahan.developer_perumahan', 'developer_perumahan']);
        $developer->perumahan = $developer->perumahan->map(function ($q) {
            $q['cover'] = asset($q['cover']);
            return $q;
        });
        return inertia()->render('pendataan/perumahan', compact('developer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Perumahan $perumahan)
    {
        $request->validate([
            'developer_id' => ['required'],
            'developer_perumahan_id' => ['required'],
            'blok' => ['required'],
            "kondisi" => ['required'],
            "tipe" => ['required'],
            "jenis" => ['required'],
            "sertifikat" => ['required'],
            "harga" => ['required'],
            "deskripsi" => ['required'],
            'cluster' => 'required',
            'kamar_tidur' => 'required',
            'lantai' => 'required',
            'kamar_mandi' => 'required',
            'garasi' => 'required',
            'daya_listrik' => 'required',
            'kondisi_parabotan' => 'required',
            'tahun_dibangun' => 'required',
            'luas_tanah' => 'required',
            'luas_bangunan' => 'required',
            'fasilitas' => 'required',
            'foto_data.*.file' => 'required',
        ]);

        $data_perumahan = $request->only(['developer_perumahan_id', 'nama', 'tipe', 'blok', 'alamat', 'jenis', 'sertifikat', 'harga', 'deskripsi', 'kondisi', 'status', 'cover']);
        if (empty($request->cover)) {
            unset($data_perumahan['cover']);
        } else {
            $nama_cover = strtotime(date('Y-m-d H:i:s')) . '.' . $request->file('cover')->getClientOriginalExtension();
            $path = "img/perumahan_file";
            // $request->file('cover')->move($path, $nama_cover);
            $path = "img/perumahan_file/$nama_cover";
            $data_perumahan['cover'] = $path;
        }
        $perumahan->update($data_perumahan);

        $data_perumahan_detail = $request->only(['cluster', 'tahun_dibangun', 'kamar_tidur', 'lantai', 'kamar_mandi', 'luas_tanah', 'luas_bangunan', 'garasi', 'daya_listrik', 'tahun_bangun', 'fasilitas', 'kondisi_parabotan']);
        if ($request->hasFile('foto_data.*.file')) {
            $final_foto = $request->file('foto_data.*.file');
            $database_foto = [];

            foreach ($final_foto as $key => $value) {
                $nama = strtotime(date('Y-m-d H:i:s')) . $key . '.' . $value->getClientOriginalExtension();
                $path = "img/perumahan_file/";
                // $value->move($path, $nama);
                $path_database = $path . $nama;
                $database_foto[] = [
                    'id' => $key,
                    'name' => $nama,
                    'file' => $path_database
                ];
            }
            $database_foto = json_encode($database_foto);
            $data_perumahan_detail['foto'] = $database_foto;
        }
        $perumahan->perumahan_detail()->update($data_perumahan_detail);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Perumahan $perumahan)
    {
        $perumahan->perumahan_detail()->delete();
        $perumahan->delete();
    }
}
