<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instalation extends Model
{
    use HasFactory;

    protected $table = 'instalations';
    protected $primaryKey = 'instalacionID';
    public $timestamps = true;

}
