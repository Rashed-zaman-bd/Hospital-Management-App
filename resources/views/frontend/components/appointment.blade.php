<div class="container mt-4">
    <h1 class="mb-3">Book Appointment</h1>
    <form id="appointmentForm" action="{{ route('appointment.store') }}" method="POST" class="container">
        @csrf
        <div class="mb-3">
            <label for="hospital" class="form-label">Select Hospital:</label>
            <select name="hospital_id" id="hospital" class="form-control" required>
                <option value="">-- Select Hospital --</option>
                @foreach ($hospitals as $hospital)
                    <option value="{{ $hospital->id }}">{{ $hospital->name }}</option>
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
                                $('<option>').val(value.id).text(value.name)
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


        $('#appointmentForm').on('submit', function(e) {
            e.preventDefault();
            $('#responseMsg').html(''); // clear

            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        $('#responseMsg').html('<div class="alert alert-success">' +
                            response.success + '</div>');
                        $('#appointmentForm')[0].reset();
                        $('#specialty, #doctor, #schedule').empty().append(
                            '<option value="">-- Select --</option>');
                        $('#appointment_date').val('');
                    } else if (response.error) {
                        $('#responseMsg').html('<div class="alert alert-danger">' + response
                            .error + '</div>');
                    } else {
                        $('#responseMsg').html(
                            '<div class="alert alert-info">Unexpected response from server.</div>'
                        );
                    }
                },
                error: function(xhr) {
                    // 401 = not authenticated (login required)
                    if (xhr.status === 401) {
                        $('#responseMsg').html(
                            '<div class="alert alert-warning">Please login to book an appointment. Redirecting to login...</div>'
                        );
                        // optionally redirect:
                        setTimeout(function() {
                            window.location.href = '/login';
                        }, 1200);
                        return;
                    }

                    // 422 = validation errors
                    if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                        let errors = xhr.responseJSON.errors;
                        let errorHtml = '<div class="alert alert-danger"><ul>';
                        $.each(errors, function(key, value) {
                            errorHtml += '<li>' + value[0] + '</li>';
                        });
                        errorHtml += '</ul></div>';
                        $('#responseMsg').html(errorHtml);
                        return;
                    }

                    // If server returned JSON with error message
                    if (xhr.responseJSON && xhr.responseJSON.error) {
                        $('#responseMsg').html('<div class="alert alert-danger">' + xhr
                            .responseJSON.error + '</div>');
                        return;
                    }

                    // If returned HTML (likely a redirect to login), attempt to detect
                    const responseText = xhr.responseText || '';
                    if (responseText.indexOf('<!doctype html') !== -1 || responseText
                        .indexOf('<html') !== -1) {
                        // probably a redirect to login page (HTML)
                        $('#responseMsg').html(
                            '<div class="alert alert-warning">You must be logged in. Redirecting to login...</div>'
                        );
                        setTimeout(function() {
                            window.location.href = '/login';
                        }, 1200);
                        return;
                    }

                    // fallback
                    $('#responseMsg').html(
                        '<div class="alert alert-danger">Something went wrong. Please try again.</div>'
                    );
                }
            });
        });


    });
</script>
