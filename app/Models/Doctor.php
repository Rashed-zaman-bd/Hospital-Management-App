<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Schedule;


class Doctor extends Model
{
    use HasFactory;


    protected $fillable = ['name', 'email', 'phone', 'qualification', 'description', 'location',  'hospital_id', 'speciality_id', 'fee', 'image'];


    // Doctor belongs to Hospital
    public function hospital()
    {
        return $this->belongsTo(Hospital::class, 'hospital_id');
    }

    // Doctor belongs to Speciality
    public function speciality()
    {
        return $this->belongsTo(Speciality::class, 'speciality_id');
    }

    public function schedules()
        {
            return $this->hasMany(Schedule::class);
        }
}
