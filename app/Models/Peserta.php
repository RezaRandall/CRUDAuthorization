<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    use HasFactory;

    protected $table = "peserta";
    protected $fillable =
    [
        'nama'
        ,'email'
        ,'xVal'
        ,'yVal'
        ,'zVal'
        ,'wVal'
        ,'aspek_intelegensi'
        ,'aspek_numerical_ability'
    ];
    protected $except = [
        "nilaiPeserta",
        "nilaiUpdates/{id}"
    ];
}
