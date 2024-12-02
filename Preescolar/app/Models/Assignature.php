<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignature extends Model
{
    use HasFactory;

    protected $table = 'assignatures';
    protected $primaryKey = 'claseID';
    public $timestamps = true;

    public function attendance()
    {
        return $this->hasOne(Attendance::class, 'asistenciaID', 'asistenciaID');
    }
    //dudo que solo sea hasOne, puede que sea Many pq una clase puede tener muchas asistencias, manda a elias a preguntar xd

    public function student()
    {
        return $this->hasMany(Student::class, 'estudianteID', 'estudianteID');
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'instructorID', 'instructorID');
    }

}
