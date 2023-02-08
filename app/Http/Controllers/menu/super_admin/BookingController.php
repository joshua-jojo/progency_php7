<?php

namespace App\Http\Controllers\menu\super_admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $booking = Booking::with(['perumahan'])->get();
        return inertia()->render('menu/super_admin/booking', compact('booking'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $booking = Booking::find($request->id);
        $booking->status = $request->status;
        $booking->update();
        switch ($request->status) {
            case 'diproses':
                $booking->load('perumahan');
                $perumahan = $booking->perumahan;
                $perumahan->update([
                    'status' => 'dp'
                ]);
                break;

            case 'terjual':
                $booking->load('perumahan');
                $perumahan = $booking->perumahan;
                $perumahan->status = 'sold';
                $perumahan->update();
                break;

            default:
                # code...
                break;
        }
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
        $perumahan = $booking->load('perumahan')->perumahan;
        $perumahan->update([
            'status' => 'tersedia'
        ]);
        $booking->delete();
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
