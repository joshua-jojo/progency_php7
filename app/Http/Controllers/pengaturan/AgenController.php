<?php

namespace App\Http\Controllers\pengaturan;

use App\Http\Controllers\Controller;
use App\Models\Agen;
use App\Models\MasterFile;
use Illuminate\Http\Request;

class AgenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agen = Agen::where('user_id', auth()->user()->id)->first();
        $text = json_encode($agen);
        $dokumen_kosong = strpos($text, 'null');
        return inertia()->render('dashboard/agen', compact('dokumen_kosong'));
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
    public function show($agen)
    {
        $agen = Agen::with(['agen_file', 'user'])->where('user_id', $agen)->first();
        $this->authorize('view', $agen);
        $agen->foto = asset($agen->foto);
        if (count($agen->agen_file)) {
            $agen->agen_file->map(function ($q) {
                $q['file'] = asset($q['file']);
                return $q;
            });
        }
        return inertia()->render('pengaturan/agen/index', compact('agen'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Agen $agen)
    {
        $agen->load('user');
        $this->authorize('update', $agen);
        $nik = $request->nik != $agen->nik;
        $nama = $request->nama != $agen->user['nama'];
        $telp = $request->telp != $agen->telp;
        $request->validate([
            'nik' => $nik ? 'required|unique:agens' : 'required',
            'nama' => $nama ? 'required|unique:users' : 'required',
            'telp' => $telp ? 'required|unique:agens' : 'required',
            'tempat_lahir' => 'required',
            'jenis_kelamin' => 'required',
        ]);
        if ($request->file('foto')) {
            $request->validate([
                'foto' => 'required|mimes:jpg,JPG,jpeg,JPEG,PNG,png',
            ]);
            $ekstensi_foto = $request->file('foto')->getClientOriginalExtension();
            $nama_foto = strtotime(date('Y-m-d H:i:s')) . '.' . $ekstensi_foto;
            $path_foto = 'img/foto_profil/' . $nama_foto;
            $request->file('foto')->move('img/foto_profil', $nama_foto);
            $agen->foto = $path_foto;
        }
        $agen = $agen->load('user');
        $agen->nik = $request->nik;

        $role = auth()->user()->role;
        if ($role == 'super admin' || $role == 'admin') {
            $agen->rating = $request->rating;
            $agen->status_terverifikasi = $request->status_terverifikasi;
        }
        $agen->telp = $request->telp;
        $agen->jenis_kelamin = $request->jenis_kelamin;
        $agen->tempat_lahir = $request->tempat_lahir;
        $agen->tanggal_lahir = $request->tanggal_lahir;
        $agen->user['nama'] = $request->nama;
        $agen->update();
        $agen->user->update();
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

    public function tambah_dokumen(Request $request)
    {
        $data = $request->validate([
            'kartu_keluarga' => 'required|mimes:jpg,JPG,jpeg,JPEG,PNG,png',
            'pendidikan_terakhir' => 'required|mimes:jpg,JPG,jpeg,JPEG,PNG,png',
            'ktp' => 'required|mimes:jpg,JPG,jpeg,JPEG,PNG,png',
            'cv' => 'required|mimes:pdf',
        ]);
        if (!count(auth()->user()->load('agen.agen_file')->agen->agen_file)) {
            foreach ($data as $key => $value) {
                $ekstensi = $request->file($key)->getClientOriginalExtension();
                $nama_baru = strtotime(date('Y-m-d H:i:s')) . "$key." . $ekstensi;
                $url_file = 'img/dokumen_agen/' . $nama_baru;
                $agen = auth()->user()->load('agen')->agen;
                $request->file($key)->move('img/dokumen_agen', $nama_baru);
                $agen->agen_file()->create([
                    'keterangan' => $key,
                    'file' => $url_file,
                    'status' => 'diproses',
                ]);
            }
        } else {
            auth()->user()->load('agen.agen_file')->agen->agen_file()->delete();
            foreach ($data as $key => $value) {
                $ekstensi = $request->file($key)->getClientOriginalExtension();
                $nama_baru = strtotime(date('Y-m-d H:i:s')) . "$key." . $ekstensi;
                $url_file = 'img/dokumen_agen/' . $nama_baru;
                $agen = auth()->user()->load('agen')->agen;
                $request->file($key)->move('img/dokumen_agen', $nama_baru);
                $agen->agen_file()->create([
                    'keterangan' => $key,
                    'file' => $url_file,
                    'status' => 'diproses',
                ]);
            }
        }
    }
    public function status_dokumen(Request $request)
    {
        $agen = Agen::where('user_id', $request->id)->first();
        $akses = auth()->user()->can('update', $agen);
        if ($akses) {
            foreach ($request->file as $key => $value) {
                MasterFile::find($value[0]['id'])->update(['status' => $value[0]['status']]);
            }
        }
    }
}
