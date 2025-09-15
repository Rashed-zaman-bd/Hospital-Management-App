<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = ['name', 'phone', 'email', 'image',  'description', 'speciality', 'qualification', 'hospital', 'location'];

}
