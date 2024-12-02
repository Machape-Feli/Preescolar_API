<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentContact extends Model
{
    use HasFactory;

    protected $table = 'student_contacts';
    protected $primaryKey = 'contactoEstudiantesID';
    public $timestamps = true;

    public function student()
    {
        return $this->belongsTo(Student::class, 'estudianteID', 'estudianteID');
    }

    public function relative()
    {
        return $this->belongsToMany(Relative::class, 'familiarID', 'familiarID');
    }
    //le puse many pq creo que un contacto puede guardar a 2 o 3 familiares

}
