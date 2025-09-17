@if (session('success'))
    <div class="alert alert-success mt-2">
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger mt-2">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif



<section id="contact" class="contact section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2>Contact</h2>
        <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
    </div><!-- End Section Title -->

    <div class="mb-5" data-aos="fade-up" data-aos-delay="200">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3651.031270861464!2d90.39945221498153!3d23.87585498453127!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c43d69a81e0f%3A0xa8c1f79f144bd6b2!2sUttara%2C%20Dhaka!5e0!3m2!1sen!2sbd!4v1694949220097!5m2!1sen!2sbd"
            width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div><!-- End Google Maps -->

    <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">
            <div class="col-lg-6 ">
                <div class="row gy-4">

                    <div class="col-lg-12">
                        <div class="info-item d-flex flex-column justify-content-center align-items-center"
                            data-aos="fade-up" data-aos-delay="200">
                            <i class="bi bi-geo-alt"></i>
                            <h3>Address</h3>
                            <p>A108 Adam Street, New York, NY 535022</p>
                        </div>
                    </div><!-- End Info Item -->

                    <div class="col-md-6">
                        <div class="info-item d-flex flex-column justify-content-center align-items-center"
                            data-aos="fade-up" data-aos-delay="300">
                            <i class="bi bi-telephone"></i>
                            <h3>Call Us</h3>
                            <p>+1 5589 55488 55</p>
                        </div>
                    </div><!-- End Info Item -->

                    <div class="col-md-6">
                        <div class="info-item d-flex flex-column justify-content-center align-items-center"
                            data-aos="fade-up" data-aos-delay="400">
                            <i class="bi bi-envelope"></i>
                            <h3>Email Us</h3>
                            <p>info@example.com</p>
                        </div>
                    </div><!-- End Info Item -->

                </div>
            </div>

            <div class="col-lg-6">
                <form id="messageForm" action="{{ route('message.store') }}" method="post" role="form">
                    @csrf
                    <div class="row gy-4">

                        <div class="col-md-6 ">
                            <input type="text" name="name"
                                class="form-control @error('name') is-invalid @enderror" placeholder="Your Name"
                                required="">
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 ">
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" placeholder="Your Email" required="">
                            @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <input type="text" class="form-control @error('subject') is-invalid @enderror"
                                name="subject" placeholder="Subject" required="">
                            @error('subject')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-3">
                            <textarea class="form-control @error('message') is-invalid @enderror" name="message" id="message" rows="10"
                                maxlength="200" placeholder="Message" required>{{ old('message') }}</textarea>

                            <!-- Character counter -->
                            <small id="charCount" class="text-muted">0 / 200 </small>

                            @error('message')
                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="col-md-12 text-center">

                            <button type="submit"
                                style="background-color: #3f73c0; color: white; padding: 10px 20px; border: none; border-radius: 5px;">
                                Send Message
                            </button>

                        </div>

                    </div>
                </form>
            </div><!-- End Contact Form -->

        </div>

    </div>

</section>

<script>
    document.getElementById('messageForm').addEventListener('submit', function(e) {
        @if (!Auth::check())
            e.preventDefault();
            alert('Please login first to send your message.');
            window.location.href = "{{ route('login') }}";
        @endif
    });
</script>


<script>
    (function() {
        const textarea = document.getElementById('message');
        const charCount = document.getElementById('charCount');
        const MAX = 200;

        function updateCount() {
            let value = textarea.value;

            // Prevent more than MAX characters (works for typing & pasting)
            if (value.length > MAX) {
                textarea.value = value.substring(0, MAX);
            }

            const current = textarea.value.length;
            const remaining = MAX - current;

            // Update counter text
            charCount.textContent = `${current} / ${remaining}`;

            // Change color near the limit
            if (remaining <= 20) {
                charCount.classList.add('text-danger');
                charCount.classList.remove('text-muted');
            } else {
                charCount.classList.add('text-muted');
                charCount.classList.remove('text-danger');
            }
        }

        // Initialize and attach listeners
        updateCount();
        textarea.addEventListener('input', updateCount);
        textarea.addEventListener('paste', updateCount);
    })();
</script>
