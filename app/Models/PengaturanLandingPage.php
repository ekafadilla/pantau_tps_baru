<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengaturanLandingPage extends Model
{
    protected $table = 'pengaturan_landing_pages';

    protected $fillable = [
        'kunci',
        'nilai',
    ];
}