<?php

namespace App\Http\Controllers;

use Log;
use Carbon\Carbon;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Schedule;
use App\Models\Speciality;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\DoctorSchedule;
use Illuminate\Support\Facades\DB;
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
        $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'date' => 'required|date|after_or_equal:today',
        ]);

        $doctorId = $request->doctor_id;
        $date = Carbon::parse($request->date)->format('Y-m-d');
        $day = Carbon::parse($date)->format('l');

        // Define slot range: 4:00 PM to 10:00 PM (360 minutes = 36 slots of 10 minutes)
        $start = Carbon::createFromFormat('Y-m-d H:i:s', $date . ' 16:00:00');
        $end = Carbon::createFromFormat('Y-m-d H:i:s', $date . ' 22:00:00');

        // Load existing slots for this doctor/date
        $existingSlots = Schedule::where('doctor_id', $doctorId)
            ->where('date', $date)
            ->get()
            ->keyBy('slot_time');

        $slots = [];
        $time = $start->copy();
        $slotCount = 0;

        while ($time->lt($end) && $slotCount < 36) {
            $slotTimeHms = $time->format('H:i:s');
            $slotTimeView = $time->format('H:i');

            // Skip past slots for today
            if (Carbon::parse($date)->isToday() && $time->lte(Carbon::now())) {
                $time->addMinutes(10);
                $slotCount++;
                continue;
            }

            // Check if slot exists in DB
            if (!isset($existingSlots[$slotTimeHms])) {
                // Create new slot
                $schedule = Schedule::create([
                    'doctor_id' => $doctorId,
                    'date' => $date,
                    'day' => $day,
                    'slot_time' => $slotTimeHms,
                    'status' => 'available',
                ]);
                $slots[] = [
                    'id' => $schedule->id,
                    'slot_time' => $slotTimeView,
                    'status' => $schedule->status,
                ];
            } elseif ($existingSlots[$slotTimeHms]->status === 'available') {
                // Only include available slots
                $slots[] = [
                    'id' => $existingSlots[$slotTimeHms]->id,
                    'slot_time' => $slotTimeView,
                    'status' => $existingSlots[$slotTimeHms]->status,
                ];
            }

            $time->addMinutes(10);
            $slotCount++;
        }

        return response()->json($slots);
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return $request->ajax()
                ? response()->json(['error' => 'Please login to book an appointment.'], 401)
                : redirect()->route('login')->with('error', 'Please login to book an appointment.');
        }

        $request->validate([
            'hospital_id' => 'required|exists:hospitals,id',
            // 👇 fix table name here (specialities vs specialties)
            'speciality_id' => 'required|exists:specialities,id',
            'doctor_id' => 'required|exists:doctors,id',
            'appointment_date' => 'required|date|after_or_equal:today',
            'schedule_id' => 'required|exists:schedules,id',
            'patient_name' => 'required|string|max:255',
            'patient_email' => 'required|email|max:255',
            'patient_phone' => 'required|string|max:20',
        ]);

        DB::beginTransaction();
        try {
            $schedule = Schedule::where('id', $request->schedule_id)
                ->lockForUpdate()
                ->first();

            if (!$schedule) {
                DB::rollBack();
                return response()->json(['error' => 'Selected slot not found.'], 404);
            }

            if ($schedule->status !== 'available') {
                DB::rollBack();
                return response()->json(['error' => 'This time slot is already booked.'], 422);
            }

            // check existing appointment
            $exists = Appointment::where('doctor_id', $request->doctor_id)
                ->where('appointment_date', Carbon::parse($request->appointment_date)->format('Y-m-d'))
                ->where('appointment_time', $schedule->slot_time)
                ->exists();

            if ($exists) {
                DB::rollBack();
                return response()->json(['error' => 'This slot is already booked.'], 422);
            }

            $appointment = Appointment::create([
                'appointment_code' => 'APT-' . time(),
                'doctor_id' => $request->doctor_id,
                'user_id' => Auth::id(),
                'patient_name' => $request->patient_name,
                'patient_email' => $request->patient_email,
                'patient_phone' => $request->patient_phone,
                'appointment_date' => Carbon::parse($request->appointment_date)->format('Y-m-d'),
                'appointment_time' => $schedule->slot_time,
                'status' => 'pending',
            ]);

            $schedule->update([
                'status' => 'booked',
                'appointment_id' => $appointment->id,
            ]);

            DB::commit();

            return response()->json(['success' => 'Appointment booked successfully!']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }






}
