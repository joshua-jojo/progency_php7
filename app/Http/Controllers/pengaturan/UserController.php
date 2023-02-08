<?php

namespace App\Http\Controllers\pengaturan;

use App\Http\Controllers\Controller;
use App\Models\Agen;
use App\Models\Developer;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', User::class);
        $user = User::orderBy('nama', 'asc')->get();
        return inertia()->render(
            'pengaturan/user/index',
            compact(['user'])
        );
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
            'nama' => 'required|unique:users',
            'email' => 'required|unique:users',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
            'role' => 'required',
        ]);
        $request['password'] = bcrypt($request->password);
        User::create($request->all());
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
    public function update(Request $request, User $user)
    {
        if ($request->user()->cannot('update', User::class)) {
            return abort(403, 'akses tidak diizinkan');
        }
        $request->validate([
            'nama' => 'required',
            'email' => 'required',
            'role' => 'required',
        ]);
        $nama = $request->nama != $user->nama;
        $email = $request->email != $user->email;
        $role = $request->role != $user->role;
        $developer = $request->role == 'developer';
        $agen = $request->role == 'agen';

        if ($nama) {
            $request->validate([
                'nama' => 'unique:users',
            ]);
        }
        if ($email) {
            $request->validate([
                'email' => 'unique:users',
            ]);
        }

        if ($role) {
            if ($agen) {
                $user->load('agen');
                if (empty($user->agen)) {
                    Agen::create([
                        'user_id' => $user->id
                    ]);
                }
            } else if ($developer) {
                $user->load('developer');
                if (empty($user->developer)) {
                    Developer::create([
                        'user_id' => $user->id
                    ]);
                }
            }
        }

        $user->nama = $request->nama;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if (auth()->user()->can('delete')) {
            return abort(403, 'akses tidak diizinkan');
        }
        $user->delete();
    }
}
