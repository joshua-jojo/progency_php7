<?php

namespace App\Rules;

use App\Models\Perumahan;
use Illuminate\Contracts\Validation\Rule;

class PerumahanRules implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $status = true;
        $developer = auth()->user()->load('developer');
        $developer = $developer->developer['id'];
        $perumahan = Perumahan::where('developer_id', $developer)->where('nama', 'like', "%$value%")->count();
        if ($perumahan) {
            $status = false;
        }
        return $status;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Rumah telah tersedia.';
    }
}
