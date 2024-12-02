<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $table = 'teachers';
    protected $primaryKey = 'instructorID';
    public $timestamps = true;

    public function assignature()
    {
        return $this->hasMany(Assignature::class, 'claseID', 'claseID');
    }

}
