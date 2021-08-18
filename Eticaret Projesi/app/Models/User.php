<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use  SoftDeletes;
    protected $table='user';

    protected $fillable = 
    [
        'adsoyad', 'email', 'sifre','aktivasyon_anahtari','aktif_mi','yonetici_mi'
    ];
    protected $hidden = [
        'sifre', 'aktivasyon_anahtari',];

    const DELETED_AT='deleted_at';
 

    public function getAuthPassword()
    {
        return $this->sifre;
    }
    public function detay(){
        return $this->hasOne('App\Models\KullaniciDetay')->withDefault();


    }

}
