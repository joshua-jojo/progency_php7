<?php

namespace App\Http\Controllers\menu\booking_perumahan;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Perumahan;
use Illuminate\Http\Request;

class BookingPerumahanController extends Controller
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
        $data = $request->validate([
            'perumahan_id' => 'required',
            'nama' => 'required',
            'kontak' => 'required',
            'keterangan' => 'required',
        ]);
        $data['status'] = 'diproses';
        $agen = auth()->user()->load('agen')->agen;
        $perumahan = Perumahan::find($request->perumahan_id);
        $perumahan->update([
            'status' => 'dp'
        ]);
        $agen->booking()->create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        //
    }
}
