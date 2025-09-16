<h1 class="container mb-3 mt-4">Book an Appointment</h1>
<form action="{{ route('appointment.store') }}" method="POST" class="container">
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
        <label for="doctor" class="form-label">Select Doctor:</label> <select name="doctor_id" id="doctor"
            class="form-control" required>
            <option value="">-- Select Doctor --</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="appointment_date" class="form-label">Select Date:</label>
        <input type="date" id="appointment_date" name="appointment_date" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="schedule" class="form-label">Select Schedule:</label>
        <select name="schedule_id" id="schedule" class="form-control">
            <option value="">-- Select Schedule --</option>
        </select>
    </div> <!-- Patient Info -->
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
<script>
    $(document).ready(function() {

        // Load specialties
        $('#hospital').change(function() {
            var hospitalId = $(this).val();
            $('#specialty, #doctor, #schedule').empty().append(
                '<option value="">-- Select --</option>');

            if (hospitalId) {
                $.get('{{ route('get.specialties') }}', {
                    hospital_id: hospitalId
                }, function(data) {
                    $.each(data, function(key, value) {
                        $('#specialty').append('<option value="' + value.id + '">' +
                            value.name + '</option>');
                    });
                });
            }
        });

        // Load doctors
        $('#specialty').change(function() {
            var specialtyId = $(this).val();
            var hospitalId = $('#hospital').val();
            $('#doctor, #schedule').empty().append('<option value="">-- Select --</option>');

            if (specialtyId && hospitalId) {
                $.get('{{ route('get.doctors') }}', {
                    hospital_id: hospitalId,
                    speciality_id: specialtyId
                }, function(data) {
                    $.each(data, function(key, value) {
                        $('#doctor').append('<option value="' + value.id + '">' + value
                            .name + '</option>');
                    });
                });
            }
        });

        // Load schedules
        $('#doctor, #appointment_date').change(function() {
            var doctorId = $('#doctor').val();
            var date = $('#appointment_date').val();
            $('#schedule').empty().append('<option value="">-- Select Schedule --</option>');

            if (doctorId && date) {
                $.get('{{ route('get.schedules') }}', {
                    doctor_id: doctorId,
                    date: date
                }, function(data) {
                    $.each(data, function(key, value) {
                        var disabled = value.status === 'booked' ? 'disabled' : '';
                        $('#schedule').append('<option value="' + value.id + '" ' +
                            disabled + '>' + value.slot_time + ' (' + value.status +
                            ')</option>');
                    });
                });
            }
        });


        // AJAX form submission
        $('form').submit(function(e) {
            e.preventDefault();
            var form = $(this);

            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: form.serialize(),
                success: function(response) {
                    if (response.success) {
                        $('#responseMsg').html('<div class="alert alert-success">' +
                            response.success + '</div>');
                        form[0].reset();
                        $('#specialty, #doctor, #schedule').empty().append(
                            '<option value="">-- Select --</option>');
                    } else if (response.error) {
                        $('#responseMsg').html('<div class="alert alert-danger">' + response
                            .error + '</div>');
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) { // validation errors
                        let errors = xhr.responseJSON.errors;
                        let errorHtml = '<div class="alert alert-danger"><ul>';
                        $.each(errors, function(key, value) {
                            errorHtml += '<li>' + value[0] + '</li>';
                        });
                        errorHtml += '</ul></div>';
                        $('#responseMsg').html(errorHtml);
                    } else {
                        $('#responseMsg').html(
                            '<div class="alert alert-danger">Something went wrong.</div>'
                        );
                    }
                }
            });
        });


    });
</script>
