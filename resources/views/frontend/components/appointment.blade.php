<section id="appointment" class="appointment section light-background">
    <div class="container section-title" data-aos="fade-up">
        <h2>MAKE AN APPOINTMENT</h2>
        <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
    </div>

    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <form id="appointmentForm" action="{{ route('appointment.store') }}" method="post" role="form">
            @csrf
            <div class="row">
                <div class="col-md-4 form-group">
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                        placeholder="Your Name" required>
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 form-group mt-3 mt-md-0">
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                        value="" placeholder="Your Email">
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4 form-group mt-3 mt-md-0">
                    <input type="tel" name="phone" class="form-control @error('phone') is-invalid @enderror"
                        placeholder="Your Phone" required>
                    @error('phone')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 form-group mt-3">
                    <input type="date" name="date" class="form-control" required>
                </div>
                <div class="col-md-4 form-group mt-3">
                    <select name="department" class="form-select" required>
                        <option value="">Select Department</option>
                        <option value="Department 1">Department 1</option>
                        <option value="Department 2">Department 2</option>
                        <option value="Department 3">Department 3</option>
                    </select>
                </div>
                <div class="col-md-4 form-group mt-3">
                    @if (request('doctor'))
                        <input type="hidden" name="doctor" value="{{ request('doctor') }}">
                        <input type="text" class="form-control" value="{{ request('doctor') }}" disabled>
                    @else
                        <select name="doctor" class="form-select" required>
                            <option value="">Select Doctor</option>
                            <option value="Doctor 1">Doctor 1</option>
                            <option value="Doctor 2">Doctor 2</option>
                            <option value="Doctor 3">Doctor 3</option>
                        </select>
                    @endif


                </div>
            </div>

            <div class="form-group mt-3">
                <textarea class="form-control @error('message') is-invalid @enderror" name="message" id="message" rows="5"
                    maxlength="200" placeholder="Message">{{ old('message') }}</textarea>

                <!-- Character counter -->
                <small id="charCount" class="text-muted">0 / 200 characters</small>

                @error('message')
                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="mt-3">
                <div class="text-center">
                    <button type="submit"
                        style="background-color: #3f73c0; color: white; padding: 10px 40px; border: none; border-radius: 5px;">
                        Send Message
                    </button>
                </div>
            </div>
        </form>
    </div>
</section>

<script>
    document.getElementById('appointmentForm').addEventListener('submit', function(e) {
        @if (!Auth::check())
            e.preventDefault();
            alert('Please login first to make an appointment.');
            window.location.href = "{{ route('login') }}";
        @endif
    });
</script>
