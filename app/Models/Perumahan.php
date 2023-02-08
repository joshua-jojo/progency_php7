<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perumahan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function perumahan_detail()
    {
        return $this->hasOne(PerumahanDetail::class);
    }
    public function developer()
    {
        return $this->belongsTo(Developer::class);
    }
    public function developer_perumahan()
    {
        return $this->belongsTo(DeveloperPerumahan::class);
    }
    public function booking()
    {
        return $this->hasOne(Booking::class);
    }
}
