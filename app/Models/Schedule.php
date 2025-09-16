<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Schedule extends Model
{
use HasFactory;


protected $fillable = ['doctor_id', 'date',  'day', 'slot_time', 'status', 'appointment_id'];


public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
}
