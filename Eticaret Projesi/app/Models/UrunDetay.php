<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UrunDetay extends Model
{
    use HasFactory;
    protected $table = "urun_detay";
    public $timestamps = FALSE; 
    
    public function urun ()
    {
        return $this->belongsTo('App\Models\Urun');
    }
}

