<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Schedule;
use App\Models\Speciality;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\DoctorSchedule;
use Illuminate\Support\Facades\Auth;


class AppointmentController extends Controller
{
    // Page
    public function create()
    {
        $hospitals = Hospital::all();
        return view('frontend.pages.appointment_page', compact('hospitals'));
    }



    public function getSpecialties(Request $request)
    {
        $hospitalId = $request->hospital_id;
        $specialties = Speciality::whereHas('doctors', function ($query) use ($hospitalId) {
            $query->where('hospital_id', $hospitalId);
        })->get();

        return response()->json($specialties);
    }

   public function getDoctors(Request $request)
    {
        $hospitalId = $request->hospital_id;
        $specialtyId = $request->speciality_id;
        $doctors = Doctor::where('hospital_id', $hospitalId)
                         ->where('speciality_id', $specialtyId)
                         ->get();

        return response()->json($doctors);
    }

  public function getSchedules(Request $request)
    {
        $doctorId = $request->doctor_id;
        $date = $request->date;

        // Get all existing slots for this doctor and date
        $existingSlots = Schedule::where('doctor_id', $doctorId)
            ->where('date', $date)
            ->get()
            ->keyBy('slot_time'); // key by time for easy lookup

        $startTime = Carbon::createFromTime(16, 0, 0);
        $endTime = Carbon::createFromTime(22, 0, 0);
        $slots = [];
        $time = $startTime->copy();

        while ($time < $endTime) {
            $timeFormatted = $time->format('H:i:s');

            if (isset($existingSlots[$timeFormatted])) {
                // Already exists in DB
                $schedule = $existingSlots[$timeFormatted];
                $slots[] = [
                    'id' => $schedule->id,
                    'slot_time' => $schedule->slot_time,
                    'status' => $schedule->status,
                ];
            } else {
                // Create new slot in DB
                $schedule = Schedule::create([
                    'doctor_id' => $doctorId,
                    'date' => $date,
                    'slot_time' => $timeFormatted,
                    'status' => 'available',
                ]);

                $slots[] = [
                    'id' => $schedule->id,
                    'slot_time' => $schedule->slot_time,
                    'status' => $schedule->status,
                ];
            }

            $time->addMinutes(10);
        }

        return response()->json($slots);
    }






    // Book Appointment
   public function store(Request $request)
    {
        if (!Auth::check()) {
            // For AJAX, return JSON error
            if ($request->ajax()) {
                return response()->json(['error' => 'Please login to book an appointment.'], 401);
            }
            return redirect()->route('login')->with('error', 'Please login to book an appointment.');
        }

        $request->validate([
            'hospital_id' => 'required',
            'speciality_id' => 'required',
            'doctor_id' => 'required',
            'appointment_date' => 'required|date',
            'schedule_id' => 'required|exists:schedules,id',
            'patient_name' => 'required|string|max:255',
            'patient_email' => 'required|email',
            'patient_phone' => 'required|string|max:20',
        ]);

        $schedule = Schedule::findOrFail($request->schedule_id);

        if ($schedule->status === 'booked') {
            if ($request->ajax()) {
                return response()->json(['error' => 'This time slot is already booked.'], 422);
            }
            return redirect()->back()->with('error', 'This time slot is already booked.');
        }

        $appointment = Appointment::create([
            'appointment_code' => 'APT-' . time(),
            'doctor_id'        => $request->doctor_id,
            'user_id'          => Auth::id(),
            'patient_name'     => $request->patient_name,
            'patient_email'    => $request->patient_email,
            'patient_phone'    => $request->patient_phone,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $schedule->slot_time,
            'status'           => 'pending',
        ]);

        // Mark schedule as booked
        $schedule->update(['status' => 'booked', 'appointment_id' => $appointment->id]);

        // Return JSON for AJAX
        if ($request->ajax()) {
            return response()->json(['success' => 'Appointment booked successfully!']);
        }

        return redirect()->back()->with('success', 'Appointment booked successfully!');
    }





}
