<?php

namespace App\Http\Controllers\pengaturan;

use App\Http\Controllers\Controller;
use App\Models\Developer;
use App\Models\DeveloperPerumahan;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Provinsi;
use App\Models\User;
use Illuminate\Http\Request;

class DeveloperController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $developer)
    {
        $developer = Developer::with('user',  'developer_perumahan')->where('user_id', $developer->id)->first();
        $this->authorize('view', $developer);
        $developer->developer_perumahan->map(function ($q) {
            $q->mark = json_decode($q->mark);
            $q->polygon = json_decode($q->polygon);
            return $q;
        });
        $provinsi = Provinsi::with(['kabupaten.kecamatan.kota'])->get();
        $developer->logo = $developer->logo ? asset($developer->logo) : null;
        // if ($developer->dokumen) {
        //     $developer->dokumen = collect(json_decode($developer->dokumen));
        //     $developer->dokumen->map(function ($q) {
        //         $q->path = asset($q->path);
        //         return $q;
        //     });
        // }
        $master = compact('developer', 'provinsi');
        return inertia()->render('pengaturan/developer/index', $master);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Developer $developer)
    {
        $this->authorize('update', $developer);
        $developer->load('user');

        $nama = $request->nama != $developer->user['nama'];
        $telepon = $request->telp != $developer->telp;
        $logo = $request->file('logo') != null;
        $status_terverifikasi = $request->status_terverifikasi != $developer->status_terverifikasi;

        if ($nama) {
            $nama = '|unique:users';
        }

        if ($telepon) {
            $telepon = '|unique:developers';
        }

        if ($status_terverifikasi) {
            $this->authorize('status_terverifikasi', $developer);
            $developer->status_terverifikasi = $request->status_terverifikasi;
        }

        $request->validate([
            'nama' => 'required' . $nama,
            'telp' => 'required' . $telepon,
        ]);
        if ($logo) {
            $request->validate([
                'logo' => 'mimes:jpg,JPG,jpeg,JPEG,png,PNG'
            ]);
            $ekstensi = $request->file('logo')->getClientOriginalExtension();
            $nama_logo = strtotime(date('Y-m-d H:i:s')) . '.' . $ekstensi;
            $path = 'img/developer_logo';
            $path_database = $path . '/' . $nama_logo;
            $request->file('logo')->move($path, $nama_logo);
            $developer->logo = $path_database;
        }
        $developer->telp = $request->telp;
        $developer->update();

        $developer->user['nama'] = $request->nama;
        $developer->user->update();
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

    public function simpan_lokasi(Request $request, Developer $developer)
    {
        $data = $request->validate([
            'nama' => 'required',
            'mark' => 'required',
            'polygon' => 'required',
            'jalan' => 'required',
            'provinsi_id' => 'required',
            'kabupaten_id' => 'required',
            'kecamatan_id' => 'required',
            'kota_id' => 'required',
        ]);

        $developer->load('developer_perumahan');

        $data['mark'] = json_encode($data['mark']);
        $data['polygon'] = json_encode($data['polygon']);
        $developer->developer_perumahan()->create($data);
    }

    public function upload_dokumen(Request $request, Developer $developer)
    {
        $data = $request->validate([
            'file_1' => 'required',
            'file_2' => 'required',
            'file_3' => 'required',
        ]);

        $final = [];
        foreach ($data as $key => $value) {
            $nama = strtotime(date('Y-m-d H:i:s')) . $key;
            $ekstensi = $value->getCLientOriginalExtension();
            $nama_file = "$nama.$ekstensi";
            $path = "img/dokumen_developer/$nama_file";
            $value->move('img/dokumen_developer', $nama_file);
            $array = [
                'nama' => $nama_file,
                'path' => $path,
            ];
            array_push($final, $array);
        }

        $developer->dokumen = json_encode($final);
        $developer->update();
    }
    public function hapus_perumahan(DeveloperPerumahan $developerPerumahan)
    {
        $developerPerumahan->delete();
    }
    public function edit_perumahan(Request $request, DeveloperPerumahan $developer_perumahan)
    {
        $data = $request->validate([
            'nama' => 'required',
            'mark' => 'required',
            'polygon' => 'required',
            'jalan' => 'required',
            'provinsi_id' => 'required',
            'kabupaten_id' => 'required',
            'kecamatan_id' => 'required',
            'kota_id' => 'required',
        ]);

        $developer_perumahan->update($data);
    }
}
