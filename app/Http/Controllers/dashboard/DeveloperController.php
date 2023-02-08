<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\developer;
use App\Models\Perumahan;
use Illuminate\Http\Request;

class DeveloperController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $developer = auth()->user()->load('developer')->developer;

        $total_perumahan = Perumahan::where('developer_id', $developer->id)->count();
        $perumahan_tersedia = Perumahan::where('developer_id', $developer->id)->where('status', 'tersedia')->count();
        $perumahan_terjual = Perumahan::where('developer_id', $developer->id)->where('status', 'sold')->count();
        $perumahan_booking = Perumahan::where('developer_id', $developer->id)->where('status', 'dp')->count();
        $master = [
            'total_perumahan' => $total_perumahan,
            'perumahan_tersedia' => $perumahan_tersedia,
            'perumahan_terjual' => $perumahan_terjual,
            'perumahan_booking' => $perumahan_booking,
        ];
        return inertia()->render('dashboard/developer', compact('master'));
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
     * @param  \App\Models\developer  $developer
     * @return \Illuminate\Http\Response
     */
    public function show(developer $developer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\developer  $developer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, developer $developer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\developer  $developer
     * @return \Illuminate\Http\Response
     */
    public function destroy(developer $developer)
    {
        //
    }
}
