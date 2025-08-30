<!DOCTYPE html>
<html lang="en">

<head>
    @include('frontend.layout.head')

</head>

<body class="index-page">


    @include('frontend.layout.nav')
    <main class="main">


        @yield('content')


    </main>

    @include('frontend.layout.footer')

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

    <!-- Main JS File -->
    <script src="assets/js/main.js"></script>

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




</body>

</html>
