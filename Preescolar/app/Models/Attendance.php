<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $table = 'attendances';
    protected $primaryKey = 'asistenciaID';
    public $timestamps = true;

    public function assignature()
    {
        return $this->belongsTo(Assignature::class, 'claseID', 'claseID');
    }

    public function student()
    {
        return $this->belongsToMany(Student::class, 'estudianteID', 'estudianteID');
    }

}
