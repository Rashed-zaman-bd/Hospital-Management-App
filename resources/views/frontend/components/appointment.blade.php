<div class="container mt-4 col-md-4">
    <h1 class="mb-3">Book Appointment</h1>
    <form id="appointmentForm" action="{{ route('appointment.store') }}" method="POST" class="container">
        @csrf
        <div class="mb-3">
            <label for="hospital" class="form-label">Select Hospital:</label>
            <select name="hospital_id" id="hospital" class="form-control" required>
                <option value="">-- Select Hospital --</option>
                @foreach ($hospitals as $hospital)
                    <option value="{{ $hospital->id }}"
                        {{ isset($selectedHospital) && $selectedHospital == $hospital->id ? 'selected' : '' }}>
                        {{ $hospital->name }}
                    </option>
                @endforeach
            </select>

        </div>

        <div class="mb-3">
            <label for="specialty" class="form-label">Select Specialty:</label>
            <select name="speciality_id" id="specialty" class="form-control" required>
                <option value="">-- Select Specialty --</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="doctor" class="form-label">Select Doctor:</label>
            <select name="doctor_id" id="doctor" class="form-control" required>
                <option value="">-- Select Doctor --</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="doctor_fee" class="form-label">Doctor Fee</label>
            <input type="text" id="doctor_fee" name="doctor_fee" class="form-control" readonly>
        </div>


        <div class="mb-3">
            <label for="appointment_date" class="form-label">Select Date:</label>
            <input type="date" id="appointment_date" name="appointment_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="schedule" class="form-label">Select Schedule:</label>
            <select name="schedule_id" id="schedule" class="form-control" required>
                <option value="">-- Select Schedule --</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="patient_name" class="form-label">Patient Name</label>
            <input type="text" id="patient_name" name="patient_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="patient_email" class="form-label">Patient Email</label>
            <input type="email" id="patient_email" name="patient_email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="patient_phone" class="form-label">Patient Phone</label>
            <input type="text" id="patient_phone" name="patient_phone" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Book Appointment</button>
    </form>
    <div id="responseMsg" class="mt-3"></div>
</div>

<script>
    $(document).ready(function() {
        // Load specialties
        $('#hospital').on('change', function() {
            var hospitalId = $(this).val();
            $('#specialty, #doctor, #schedule').empty().append(
                '<option value="">-- Select --</option>');
            $('#appointment_date').val('');

            if (hospitalId) {
                $.ajax({
                    url: '{{ route('get.specialties') }}',
                    type: 'GET',
                    data: {
                        hospital_id: hospitalId
                    },
                    dataType: 'json',
                    success: function(data) {
                        $('#specialty').empty().append(
                            '<option value="">-- Select Specialty --</option>');
                        $.each(data, function(key, value) {
                            $('#specialty').append(
                                $('<option>').val(value.id).text(value.name)
                            );
                        });
                    },
                    error: function() {
                        $('#responseMsg').html(
                            '<div class="alert alert-danger">Failed to load specialties.</div>'
                        );
                    }
                });
            }
        });

        // Load doctors
        $('#specialty').on('change', function() {
            var specialtyId = $(this).val();
            var hospitalId = $('#hospital').val();
            $('#doctor, #schedule').empty().append('<option value="">-- Select --</option>');
            $('#appointment_date').val('');
            $('#doctor_fee').val(''); // clear fee when specialty changes

            if (specialtyId && hospitalId) {
                $.ajax({
                    url: '{{ route('get.doctors') }}',
                    type: 'GET',
                    data: {
                        hospital_id: hospitalId,
                        speciality_id: specialtyId
                    },
                    dataType: 'json',
                    success: function(data) {
                        $('#doctor').empty().append(
                            '<option value="">-- Select Doctor --</option>');
                        $.each(data, function(key, value) {
                            $('#doctor').append(
                                $('<option>')
                                .val(value.id)
                                .text(value.name)
                                .attr('data-fee', value
                                    .fee) // store fee in option
                            );
                        });
                    },
                    error: function() {
                        $('#responseMsg').html(
                            '<div class="alert alert-danger">Failed to load doctors.</div>'
                        );
                    }
                });
            }
        });

        // When doctor is selected, set fee input
        $('#doctor').on('change', function() {
            var fee = $(this).find(':selected').data('fee') || '';
            $('#doctor_fee').val(fee);
        });


        // Load schedules
        $('#doctor, #appointment_date').on('change', function() {
            var doctorId = $('#doctor').val();
            var date = $('#appointment_date').val();
            $('#schedule').empty().append('<option value="">-- Select Schedule --</option>');

            if (doctorId && date) {
                $.ajax({
                    url: '{{ route('get.schedules') }}',
                    type: 'GET',
                    data: {
                        doctor_id: doctorId,
                        date: date
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (!data || data.length === 0) {
                            $('#schedule').append(
                                '<option value="">No available slots</option>');
                            return;
                        }
                        $.each(data, function(key, value) {
                            $('#schedule').append(
                                $('<option>').val(value.id).text(value
                                    .slot_time + ' (' + value.status + ')')
                            );
                        });
                    },
                    error: function(xhr) {
                        $('#schedule').append(
                            '<option value="">Error loading slots</option>');
                        $('#responseMsg').html(
                            '<div class="alert alert-danger">Failed to load schedules: ' +
                            (xhr.responseJSON?.message || 'Unknown error') + '</div>');
                    }
                });
            }
        });

        // Auto load if doctor preselected
        let preHospital = "{{ $selectedHospital ?? '' }}";
        let preSpeciality = "{{ $selectedSpeciality ?? '' }}";
        let preDoctor = "{{ $selectedDoctor ?? '' }}";

        if (preHospital) {
            $('#hospital').val(preHospital).trigger('change');

            // After specialties load
            $(document).one('ajaxSuccess', function(e, xhr, settings) {
                if (settings.url.includes("get-specialties") && preSpeciality) {
                    $('#specialty').val(preSpeciality).trigger('change');
                }
            });

            // After doctors load
            $(document).on('ajaxSuccess', function(e, xhr, settings) {
                if (settings.url.includes("get-doctors") && preDoctor) {
                    $('#doctor').val(preDoctor).trigger('change');

                    // Set fee immediately
                    let fee = $('#doctor').find(':selected').data('fee') || '';
                    $('#doctor_fee').val(fee);
                }
            });
        }


        //Ajax form submission
        $('#appointmentForm').on('submit', function(e) {
            e.preventDefault(); // prevent normal form submission
            $('#responseMsg').html(''); // clear previous messages

            $.post($(this).attr('action'), $(this).serialize())
                .done(function(response) {
                    // On success
                    $('#responseMsg').html(
                        `<div class="alert alert-success">${response.success}</div>`
                    );

                    // Reset form and dropdowns
                    $('#appointmentForm')[0].reset();
                    $('#specialty, #doctor, #schedule').html(
                        '<option value="">-- Select --</option>');
                })
                .fail(function(xhr) {
                    // Default error message
                    let msg = 'Something went wrong. Please try again.';

                    // If user not logged in
                    if (xhr.status === 401) {
                        msg = 'Please login to book an appointment.';
                    }
                    // Validation errors
                    else if (xhr.status === 422 && xhr.responseJSON?.errors) {
                        msg = '<ul>';
                        $.each(xhr.responseJSON.errors, function(_, errors) {
                            msg += `<li>${errors[0]}</li>`;
                        });
                        msg += '</ul>';
                    }
                    // Server returned JSON error
                    else if (xhr.responseJSON?.error) {
                        msg = xhr.responseJSON.error;
                    }

                    $('#responseMsg').html(`<div class="alert alert-danger">${msg}</div>`);
                });
        });



    });
</script>
