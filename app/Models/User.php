<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guarded = ['id'];

    public function agen()
    {
        return $this->hasOne(Agen::class);
    }
    public function developer()
    {
        return $this->hasOne(Developer::class);
    }
    public function jawaban()
    {
        return $this->hasMany(JawabanUser::class);
    }
    public function MasterFile()
    {
        return $this->hasMany(MasterFile::class);
    }
}
