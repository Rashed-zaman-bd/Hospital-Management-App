<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = ['appointment_id', 'user_id', 'name', 'email', 'phone', 'date', 'department', 'doctor', 'message'];

}
