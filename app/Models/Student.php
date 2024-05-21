<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'fullName',
        'username',
        'email',
        'phone',
        'address',
        'birthdate',
        'imageName',
        'password',
    ];
    protected $hidden = [
        'password',
    ];
}
