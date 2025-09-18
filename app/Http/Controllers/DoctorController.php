<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Flasher\Toastr\Prime\ToastrInterface;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
{
    $doctors = Doctor::limit(8)->get();
    return view('index', compact('doctors'));
}

    public function frontendIndex()
    {
        $doctors = Doctor::get();
        return view('frontend.pages.doctors_page', compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.pages.doctor.create');
    }

    /**
     * Store a newly created resource in storage.
     */
  public function store(Request $request)
{
    $data = $request->validate([
        'name'          => ['required','string','max:255'],
        'phone'         => ['required','string','max:50'],
        'email'         => ['required','email','max:255'],
        'description'   => ['required','string'],
        'speciality'    => ['required','string','max:255'],
        'qualification' => ['required','string','max:255'],
        'hospital'      => ['required','string','max:255'],
        'location'      => ['nullable','string','max:255'],
        'image'         => ['nullable','image','mimes:jpg,jpeg,png,webp','max:2048'],
    ]);

    // Handle image upload
    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('doctors', 'public');
    }

    Doctor::create($data);

    return redirect()->route('backend.doctor')
                     ->with('success', 'Doctor created successfully.');
}



    /**
     * Display the specified resource.
     */
    public function show(Doctor $doctor)
    {
        $doctors = Doctor::latest()->get();
        return view('backend.pages.doctor.index', compact('doctors'));
    }

     public function read(string $id)
    {
        $doctors = Doctor::findOrFail($id);
        return view('backend.pages.doctor.show', compact('doctors'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Doctor $doctor)
    {
        return view('backend.pages.doctor.edit', compact('doctor'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Doctor $doctor)
{
    $data = $request->validate([
        'name'          => ['required','string','max:255'],
        'phone'         => ['required','string','max:50'],
        'email'         => ['required','email','max:255'],
        'description'   => ['required','string'],
        'speciality'    => ['required','string','max:255'],
        'qualification' => ['required','string','max:255'],
        'hospital'      => ['required','string','max:255'],
        'location'      => ['nullable','string','max:255'],
        'image'         => ['nullable','image','mimes:jpg,jpeg,png,webp','max:2048'],
    ]);

    // If new image is uploaded
    if ($request->hasFile('image')) {
        // Delete old image if exists
        if ($doctor->image && Storage::disk('public')->exists($doctor->image)) {
            Storage::disk('public')->delete($doctor->image);
        }

        // Save new image
        $data['image'] = $request->file('image')->store('doctors', 'public');
    }

    // Update doctor
    $doctor->update($data);
    toastr()->success('Doctor update successfully');
    return redirect()->route('backend.doctor');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Doctor $doctor)
    {
        if($doctor->image){
            Storage::disk('public')->delete($doctor->image);
        }
        $doctor->delete();
        toastr()->success('Doctor delete successfully');
        return redirect()->route('backend.doctor');
    }
}
