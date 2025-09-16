<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Appointment extends Model
{
use HasFactory;


protected $fillable = ['appointment_code','doctor_id','user_id','patient_name','patient_email','patient_phone','appointment_date','appointment_time','status'];


    public function doctor()
        {
        return $this->belongsTo(Doctor::class);
        }
}
