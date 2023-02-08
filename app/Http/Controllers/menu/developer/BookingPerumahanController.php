<?php

namespace App\Http\Controllers\menu\developer;

use App\Http\Controllers\Controller;
use App\Http\Middleware\Developer;
use App\Models\Booking;
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
        $hak_akses = auth()->user()->can('developer', Booking::class);
        if (!$hak_akses) {
            return abort(403, 'developer belum memenuhi ketentuan');
        }
        $developer = auth()->user()->load('developer')->developer;
        $booking = Booking::with(['perumahan'])->whereHas('perumahan', function ($q) use ($developer) {
            $q->where('developer_id', $developer->id);
        })->orderBy('status', 'asc')->get();
        return inertia()->render('menu/developer/data_booking', compact('booking'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $status = $request->status;
        switch ($status) {
            case 'terjual':
                $booking = Booking::find($request->id);
                $booking->update([
                    'status' => $request->status
                ]);

                $booking->load('perumahan');
                $booking->perumahan()->update([
                    'status' => 'sold'
                ]);
                break;

            case 'ditolak':
                $booking = Booking::find($request->id);
                $booking->update([
                    'status' => 'pengajuan penolakan'
                ]);

                break;

            default:
                # code...
                break;
        }
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
