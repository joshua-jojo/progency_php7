<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Booking;
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
        $agen = auth()->user()->load('agen.agen_file')->agen;
        $booking = Booking::where('agen_id', $agen->id)->where('status', 'diproses')->count();
        $booking_terjual = Booking::where('agen_id', $agen->id)->where('status', 'terjual')->count();
        $booking_terjual_bulanIni = Booking::where('agen_id', $agen->id)->where('status', 'terjual')->whereMonth('created_at', date('m'))->count();
        return inertia()->render('dashboard/agen', compact(['booking', 'booking_terjual', 'agen', 'booking_terjual_bulanIni']));
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
