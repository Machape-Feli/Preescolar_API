<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $table = 'grades';
    protected $primaryKey = 'calificacionID';
    public $timestamps = true;

    public function student()
    {
        return $this->belongsToMany(Student::class, 'estudienteID', 'estudianteID');
    }

}
