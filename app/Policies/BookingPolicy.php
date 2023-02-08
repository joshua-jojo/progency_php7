<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BookingPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function developer(User $user)
    {
        $developer = $user->load('developer.developer_perumahan')->developer;
        $kelengkapan_data = count($developer->developer_perumahan) > 0 ? true : false;
        return $kelengkapan_data;
    }
}
