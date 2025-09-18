<section id="doctors" class="doctors section light-background">
    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2>Doctors</h2>
        <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
    </div><!-- End Section Title -->

    <div class="container">
        <div class="row gy-3">

            @foreach ($doctors as $doctor)
                <div class="col-lg-3 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="">
                    <div class="card shadow-lg border-0 rounded-3 h-100 position-relative overflow-hidden"
                        style="background: linear-gradient(145deg, #f8f9fa, #ffffff); display: flex; flex-direction: column;">

                        <!-- Image -->
                        <div class="doctor-img-wrapper" style="height: 300px; border-radius: 8px; overflow: hidden;">
                            @if ($doctor->image)
                                <img src="{{ asset('storage/' . $doctor->image) }}" alt="{{ $doctor->name }}"
                                    style="width: 100%; height: 100%; object-fit: cover; object-position: center; overflow: hidden;">
                            @else
                                <img src="https://via.placeholder.com/300x300" alt="No Image"
                                    style="width: 100%; height: 100%; object-fit: cover; object-position: center; overflow: hidden;">
                            @endif
                        </div>

                        <!-- Title / Info -->
                        <div class="text-start p-3">
                            <h6 class="fw-bold text-dark mb-1">{{ $doctor->name }}</h6>
                            <small class="text-muted">{{ $doctor->description ?? 'Doctor' }}</small>

                            <h6 class="fw-semi-bold text-dark mt-3">Speciality</h6>
                            <small class="text-muted">{{ $doctor->speciality ?? 'Not Available' }}</small>

                            <h6 class="fw-semi-bold text-dark mt-3">Qualification</h6>
                            <small class="text-muted">{{ $doctor->qualification ?? 'Not Provided' }}</small>

                            <h6 class="fw-semi-bold text-dark mt-3">Hospital</h6>
                            <small class="text-muted">{{ $doctor->hospital ?? 'Not Mentioned' }}</small>
                        </div>

                        <!-- Button -->
                        <div class="p-3 mt-auto">
                            <a href="{{ route('appointment.create', [
                                'hospital_id' => $doctor->hospital_id,
                                'speciality_id' => $doctor->speciality_id,
                                'doctor_id' => $doctor->id,
                            ]) }}"
                                class="btn btn-dark w-100 shadow-sm" style="background: #3f73c0; border: none;">
                                Book an Appointment
                            </a>

                        </div>
                    </div>
                </div>
            @endforeach

        </div>

    </div>

</section>
