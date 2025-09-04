<?php

namespace Database\Seeders;

use App\Models\Doctor;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Doctor::create([
            'name' => 'Dr. A Jayachandra',
            'email' => 'jaya@example.com',
            'phone' => '834683147',
            'description' => 'Clinical Director and Sr. Interventional Pulmonologist',
            'speciality' => 'Pulmonology',
            'qualification' => 'MBBS, DTCD, FCCP Special training in Med. Thoracoscopy Marseilles France',
            'hospital' => 'CARE Hospitals, Nampally, Hyderabad',
            'location' => 'Hyderabad',
        ]);
        Doctor::create([
            'name' => 'Dr. A K Jinsiwale',
            'email' => 'email1@example.com',
            'phone' => '834683147',
            'description' => 'Sr. Consultant',
            'speciality' => 'Orthopaedics',
            'qualification' => 'MBBS, MS (Ortho), Dip M.V.S (Sweden), F.S.O.S',
            'hospital' => 'CARE CHL Hospitals, Indore',
            'location' => 'Indore',
        ]);
        Doctor::create([
            'name' => 'Dr. A Kanchana Lakshmi Prasanna',
            'email' => 'emal2@example.com',
            'phone' => '834683147',
            'description' => 'Sr. Consultant and Head of Department',
            'speciality' => 'Lab Medicine',
            'qualification' => 'MBBS, MD (Biochemistry), MBA . Thoracoscopy Marseilles France',
            'hospital' => 'CARE Hospitals, Health City, Arilova',
            'location' => 'Arilova',
        ]);
    }
}
