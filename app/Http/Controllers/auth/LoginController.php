<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return inertia()->render('autentikasi/login');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $auth = auth()->attempt($request->all());
        if ($auth) {
            switch (auth()->user()->role) {
                case 'agen':
                    return redirect()->route('dashboard.agen.index');
                    break;

                case 'developer':
                    return redirect()->route('dashboard.developer.index');
                    break;

                case 'admin':
                    return redirect()->route('dashboard.admin.index');
                    break;

                case 'super admin':
                    return redirect()->route('dashboard.superadmin.index');
                    break;

                default:
                    return abort(403, 'akses tidak diizinkan');
                    break;
            }
        } else {
            return back()->with('message', 'Email atau password tidak cocok!');
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
