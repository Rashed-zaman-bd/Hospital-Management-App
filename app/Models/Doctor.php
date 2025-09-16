<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Schedule;


class Doctor extends Model
{
    use HasFactory;


    protected $fillable = ['name', 'email', 'phone', 'qualification', 'description', 'hospital_id', 'speciality_id', 'fee', 'image'];


    public function hospital()
        {
            return $this->belongsTo(Hospital::class);
        }

    public function specialty()
        {
            return $this->belongsTo(Speciality::class);
        }

    public function schedules()
        {
            return $this->hasMany(Schedule::class);
        }
}
