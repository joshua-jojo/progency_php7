<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function agen()
    {
        return $this->belongsTo(Agen::class);
    }
    public function perumahan()
    {
        return $this->belongsTo(Perumahan::class);
    }
}
