<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Developer extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function perumahan()
    {
        return $this->hasMany(Perumahan::class);
    }

    public function developer_perumahan()
    {
        return $this->hasMany(DeveloperPerumahan::class);
    }
}
