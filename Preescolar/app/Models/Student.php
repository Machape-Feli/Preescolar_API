<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = 'students';
    protected $primaryKey = 'estudianteID';
    public $timestamps = true;

    public function attendance()
    {
        return $this->hasOne(Attendance::class, 'asistenciaID', 'asistenciaID');
    }

    public function studentContact()
    {
        return $this->hasMany(StudentContact::class, 'contactoEstudiantesID', 'contactoEstudiantesID');
    }
    //lo hice como si puedce tener varios contactos, !si se ocupa mas nomas cambiamos, le preguntan al profe que como ve xd (manda a elias)

    public function assignature()
    {
        return $this->belongsToMany(Assignature::class, 'claseID', 'claseID');
    }

    public function grade()//califiicaciones
    {
        return $this->hasMany(Grade::class, 'calificacionesID', 'calificacionesID');
    }

}
