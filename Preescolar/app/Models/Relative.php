<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relative extends Model
{
    use HasFactory;

    protected $table = 'relatives';
    protected $primaryKey = 'familiarID';
    public $timestamps = true;

    public function studentContact()
    {
        return $this->hasOne(studentContact::class, 'familiarID', 'familiarID');
    }
    //le puse One pq un familiar solo puede estar registrado con un contacto jiji
}
