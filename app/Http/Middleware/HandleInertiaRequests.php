<?php

namespace App\Http\Middleware;

use App\Models\MasterPerusahaan;
use Illuminate\Http\Request;
use Inertia\Middleware;
use Tightenco\Ziggy\Ziggy;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request)
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        $perusahaan = MasterPerusahaan::first();
        $perusahaan['logo'] = asset($perusahaan['logo']);
        $user = $request->user();
        $developer = false;
        $agen = false;
        $admin = false;
        $super_admin = false;

        if ($user) {
            switch ($user->role) {
                case 'agen':
                    $user = $user->load(['agen.agen_file']);
                    $user->agen->foto = asset($user->agen->foto);
                    $agen = true;
                    break;

                case 'developer':
                    $user = $user->load(['developer.developer_perumahan']);
                    $user->developer->logo = $user->developer->logo ? asset($user->developer->logo) : asset('base_data/profile.png');
                    $developer = true;
                    break;
                case 'admin':
                    $admin = true;
                case 'super admin':
                    $super_admin = true;
                default:
                    break;
            }
        }
        return array_merge(parent::share($request), [
            'auth' => [
                'user' => $user,
            ],
            'ziggy' => function () use ($request) {
                return array_merge((new Ziggy)->toArray(), [
                    'location' => $request->url(),
                ]);
            },
            'MasterPerusahaan' => $perusahaan,
            'login' => auth()->check(),
            'flash' => $request->session()->get('message'),
            'foto_profil' => asset('base_data/profile.png'),
            'role' => [
                'admin' => $admin,
                'super_admin' => $super_admin,
                'agen' => $agen,
                'developer' => $developer,
            ]
        ]);
    }
}
