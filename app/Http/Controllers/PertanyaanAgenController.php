<?php

namespace App\Http\Controllers;

use App\Models\JawabanUser;
use App\Models\Pertanyaan;
use Illuminate\Http\Request;

class PertanyaanAgenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $pertanyaan = Pertanyaan::all();
        $pertanyaan = $pertanyaan->map(function ($q) use ($user_id) {
            return [
                'pertanyaan_id' => $q->id,
                'pertanyaan' => $q->pertanyaan,
                'user_id' => $user_id,
                'jawaban' => null,
            ];
        });
        return inertia()->render('pertanyaan_agen', compact('pertanyaan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = collect($request->data_jawaban)->map(function ($q) {
            unset($q['pertanyaan']);
            if ($q['jawaban'] == null) {
                $q['jawaban'] = '-';
            }
            return $q;
        })->toArray();
        JawabanUser::insert($data);
        return redirect()->route('agen.index');
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
