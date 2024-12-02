<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens; 

class UserAuth extends Model
{
    use HasFactory, HasApiTokens;

    protected $table = 'user_auths';
    protected $primaryKey = 'UserID';
    public $timestamps = true;

    protected $fillable = [
        'name',
        'email',
        'password'
    ];
// implementarlo en teachers

}
