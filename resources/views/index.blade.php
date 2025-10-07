@extends('frontend.layout.app')

@section('content')
    <!-- Hero Section -->
    <section id="hero" class="hero section">

        <div id="hero-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">

            <div class="carousel-item active">
                <img src="assets/img/hero-carousel/hero-1.webp" alt="">
                <div class="container">
                    <h2>Welcome to Hospital</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                        et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                        aliquip ex ea commodo consequat.</p>
                    <a href="#about" class="btn-get-started">Read More</a>
                </div>
            </div><!-- End Carousel Item -->

            <div class="carousel-item">
                <img src="assets/img/hero-carousel/hero-2.jpg" alt="">
                <div class="container">
                    <h2>At vero eos et accusamus</h2>
                    <p>Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime
                        placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem
                        quibusdam et aut officiis debitis aut.</p>
                    <a href="#about" class="btn-get-started">Read More</a>
                </div>
            </div><!-- End Carousel Item -->

            <div class="carousel-item">
                <img src="assets/img/hero-carousel/hero-3.jpg" alt="">
                <div class="container">
                    <h2>Temporibus autem quibusdam</h2>
                    <p>Beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit
                        aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt omnis iste
                        natus error sit voluptatem accusantium.</p>
                    <a href="#about" class="btn-get-started">Read More</a>
                </div>
            </div><!-- End Carousel Item -->

            <a class="carousel-control-prev" href="#hero-carousel" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
            </a>

            <a class="carousel-control-next" href="#hero-carousel" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
            </a>

            <ol class="carousel-indicators"></ol>

        </div>

    </section><!-- /Hero Section -->

    <!-- Stats Section -->
    <section id="stats" class="stats section">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row gy-4">

                <div class="col-lg-3 col-md-6">
                    <div class="stats-item d-flex align-items-center w-100 h-100">
                        <i class="fas fa-user-md flex-shrink-0"></i>
                        <div>
                            <span data-purecounter-start="0" data-purecounter-end="25" data-purecounter-duration="1"
                                class="purecounter"></span>
                            <p>Doctors</p>
                        </div>
                    </div>
                </div><!-- End Stats Item -->

                <div class="col-lg-3 col-md-6">
                    <div class="stats-item d-flex align-items-center w-100 h-100">
                        <i class="far fa-hospital flex-shrink-0"></i>
                        <div>
                            <span data-purecounter-start="0" data-purecounter-end="15" data-purecounter-duration="1"
                                class="purecounter"></span>
                            <p>Departments</p>
                        </div>
                    </div>
                </div><!-- End Stats Item -->

                <div class="col-lg-3 col-md-6">
                    <div class="stats-item d-flex align-items-center w-100 h-100">
                        <i class="fas fa-flask flex-shrink-0"></i>
                        <div>
                            <span data-purecounter-start="0" data-purecounter-end="8" data-purecounter-duration="1"
                                class="purecounter"></span>
                            <p>Research Labs</p>
                        </div>
                    </div>
                </div><!-- End Stats Item -->

                <div class="col-lg-3 col-md-6">
                    <div class="stats-item d-flex align-items-center w-100 h-100">
                        <i class="fas fa-award flex-shrink-0"></i>
                        <div>
                            <span data-purecounter-start="0" data-purecounter-end="150" data-purecounter-duration="1"
                                class="purecounter"></span>
                            <p>Awards</p>
                        </div>
                    </div>
                </div><!-- End Stats Item -->

            </div>

        </div>

    </section><!-- /Stats Section -->

    <!-- Doctors Section -->
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
                                <small
                                    class="text-muted">{{ $doctor->speciality ? $doctor->speciality->name : 'N/A' }}</small>

                                <h6 class="fw-semi-bold text-dark mt-3">Qualification</h6>
                                <small class="text-muted">{{ $doctor->qualification ?? 'Not Provided' }}</small>

                                <h6 class="fw-semi-bold text-dark mt-3">Hospital</h6>
                                <small class="text-muted">{{ $doctor->hospital ? $doctor->hospital->name : 'N/A' }}</small>
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
            <div class="text-end mt-4">
                <a href="{{ route('page.doctors') }}" class="btn">
                    Show More Doctors &nbsp;<i class="bi bi-arrow-right me-1"></i>
                </a>
            </div>
        </div>

    </section> <!-- /Doctors Section -->

    <!-- About Section -->
    <section id="about" class="about section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>About Us<br></h2>
            <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
        </div><!-- End Section Title -->

        <div class="container">

            <div class="row gy-4">
                <div class="col-lg-6 position-relative align-self-start" data-aos="fade-up" data-aos-delay="100">
                    <img src="assets/img/about.jpg" class="img-fluid" alt="">
                    <a href="https://www.youtube.com/watch?v=TsuZsm07mGY&t=15s" class="glightbox pulsating-play-btn"></a>
                </div>
                <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="200">
                    <h3>Voluptatem dignissimos provident quasi corporis voluptates sit assumenda.</h3>
                    <p class="fst-italic">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                        et dolore
                        magna aliqua.
                    </p>
                    <ul>
                        <li><i class="bi bi-check2-all"></i> <span>Ullamco laboris nisi ut aliquip ex ea commodo
                                consequat.</span></li>
                        <li><i class="bi bi-check2-all"></i> <span>Duis aute irure dolor in reprehenderit in voluptate
                                velit.</span></li>
                        <li><i class="bi bi-check2-all"></i> <span>Ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                Duis aute irure dolor in reprehenderit in voluptate trideta storacalaperda mastiro dolore eu
                                fugiat nulla pariatur.</span></li>
                    </ul>
                    <p>
                        Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate
                        velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident
                    </p>
                </div>
            </div>

        </div>

    </section><!-- /About Section -->

    <!-- Services Section -->
    <section id="services" class="services section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Services</h2>
            <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
        </div><!-- End Section Title -->

        <div class="container">

            <div class="row gy-4">

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="service-item  position-relative">
                        <div class="icon">
                            <i class="fas fa-heartbeat"></i>
                        </div>
                        <a href="#" class="stretched-link">
                            <h3>Nesciunt Mete</h3>
                        </a>
                        <p>Provident nihil minus qui consequatur non omnis maiores. Eos accusantium minus dolores iure
                            perferendis tempore et consequatur.</p>
                    </div>
                </div><!-- End Service Item -->

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="service-item position-relative">
                        <div class="icon">
                            <i class="fas fa-pills"></i>
                        </div>
                        <a href="#" class="stretched-link">
                            <h3>Eosle Commodi</h3>
                        </a>
                        <p>Ut autem aut autem non a. Sint sint sit facilis nam iusto sint. Libero corrupti neque eum hic non
                            ut nesciunt dolorem.</p>
                    </div>
                </div><!-- End Service Item -->

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="service-item position-relative">
                        <div class="icon">
                            <i class="fas fa-hospital-user"></i>
                        </div>
                        <a href="#" class="stretched-link">
                            <h3>Ledo Markt</h3>
                        </a>
                        <p>Ut excepturi voluptatem nisi sed. Quidem fuga consequatur. Minus ea aut. Vel qui id voluptas
                            adipisci eos earum corrupti.</p>
                    </div>
                </div><!-- End Service Item -->

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="service-item position-relative">
                        <div class="icon">
                            <i class="fas fa-dna"></i>
                        </div>
                        <a href="#" class="stretched-link">
                            <h3>Asperiores Commodit</h3>
                        </a>
                        <p>Non et temporibus minus omnis sed dolor esse consequatur. Cupiditate sed error ea fuga sit
                            provident adipisci neque.</p>
                        <a href="#" class="stretched-link"></a>
                    </div>
                </div><!-- End Service Item -->

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
                    <div class="service-item position-relative">
                        <div class="icon">
                            <i class="fas fa-wheelchair"></i>
                        </div>
                        <a href="#" class="stretched-link">
                            <h3>Velit Doloremque</h3>
                        </a>
                        <p>Cumque et suscipit saepe. Est maiores autem enim facilis ut aut ipsam corporis aut. Sed animi at
                            autem alias eius labore.</p>
                        <a href="#" class="stretched-link"></a>
                    </div>
                </div><!-- End Service Item -->

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
                    <div class="service-item position-relative">
                        <div class="icon">
                            <i class="fas fa-notes-medical"></i>
                        </div>
                        <a href="#" class="stretched-link">
                            <h3>Dolori Architecto</h3>
                        </a>
                        <p>Hic molestias ea quibusdam eos. Fugiat enim doloremque aut neque non et debitis iure. Corrupti
                            recusandae ducimus enim.</p>
                        <a href="#" class="stretched-link"></a>
                    </div>
                </div><!-- End Service Item -->

            </div>

        </div>

    </section><!-- /Services Section -->

    <!-- Tabs Section -->
    <section id="tabs" class="tabs section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Departments</h2>
            <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row">
                <div class="col-lg-3">
                    <ul class="nav nav-tabs flex-column">
                        <li class="nav-item">
                            <a class="nav-link active show" data-bs-toggle="tab" href="#tabs-tab-1">Cardiology</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#tabs-tab-2">Neurology</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#tabs-tab-3">Hepatology</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#tabs-tab-4">Pediatrics</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#tabs-tab-5">Ophthalmologists</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-9 mt-4 mt-lg-0">
                    <div class="tab-content">
                        <div class="tab-pane active show" id="tabs-tab-1">
                            <div class="row">
                                <div class="col-lg-8 details order-2 order-lg-1">
                                    <h3>Cardiology</h3>
                                    <p class="fst-italic">Qui laudantium consequatur laborum sit qui ad sapiente dila parde
                                        sonata raqer a videna mareta paulona marka</p>
                                    <p>Et nobis maiores eius. Voluptatibus ut enim blanditiis atque harum sint. Laborum eos
                                        ipsum ipsa odit magni. Incidunt hic ut molestiae aut qui. Est repellat minima
                                        eveniet eius et quis magni nihil. Consequatur dolorem quaerat quos qui similique
                                        accusamus nostrum rem vero</p>
                                </div>
                                <div class="col-lg-4 text-center order-1 order-lg-2">
                                    <img src="assets/img/departments-1.jpg" alt="" class="img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tabs-tab-2">
                            <div class="row">
                                <div class="col-lg-8 details order-2 order-lg-1">
                                    <h3>Neurology</h3>
                                    <p class="fst-italic">Qui laudantium consequatur laborum sit qui ad sapiente dila parde
                                        sonata raqer a videna mareta paulona marka</p>
                                    <p>Ea ipsum voluptatem consequatur quis est. Illum error ullam omnis quia et reiciendis
                                        sunt sunt est. Non aliquid repellendus itaque accusamus eius et velit ipsa
                                        voluptates. Optio nesciunt eaque beatae accusamus lerode pakto madirna desera vafle
                                        de nideran pal</p>
                                </div>
                                <div class="col-lg-4 text-center order-1 order-lg-2">
                                    <img src="assets/img/departments-2.jpg" alt="" class="img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tabs-tab-3">
                            <div class="row">
                                <div class="col-lg-8 details order-2 order-lg-1">
                                    <h3>Hepatology</h3>
                                    <p class="fst-italic">Eos voluptatibus quo. Odio similique illum id quidem non enim
                                        fuga. Qui natus non sunt dicta dolor et. In asperiores velit quaerat perferendis aut
                                    </p>
                                    <p>Iure officiis odit rerum. Harum sequi eum illum corrupti culpa veritatis quisquam.
                                        Neque necessitatibus illo rerum eum ut. Commodi ipsam minima molestiae sed
                                        laboriosam a iste odio. Earum odit nesciunt fugiat sit ullam. Soluta et harum
                                        voluptatem optio quae</p>
                                </div>
                                <div class="col-lg-4 text-center order-1 order-lg-2">
                                    <img src="assets/img/departments-3.jpg" alt="" class="img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tabs-tab-4">
                            <div class="row">
                                <div class="col-lg-8 details order-2 order-lg-1">
                                    <h3>Pediatrics</h3>
                                    <p class="fst-italic">Totam aperiam accusamus. Repellat consequuntur iure voluptas iure
                                        porro quis delectus</p>
                                    <p>Eaque consequuntur consequuntur libero expedita in voluptas. Nostrum ipsam
                                        necessitatibus aliquam fugiat debitis quis velit. Eum ex maxime error in consequatur
                                        corporis atque. Eligendi asperiores sed qui veritatis aperiam quia a laborum
                                        inventore</p>
                                </div>
                                <div class="col-lg-4 text-center order-1 order-lg-2">
                                    <img src="assets/img/departments-4.jpg" alt="" class="img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tabs-tab-5">
                            <div class="row">
                                <div class="col-lg-8 details order-2 order-lg-1">
                                    <h3>Ophthalmologists</h3>
                                    <p class="fst-italic">Omnis blanditiis saepe eos autem qui sunt debitis porro quia.</p>
                                    <p>Exercitationem nostrum omnis. Ut reiciendis repudiandae minus. Omnis recusandae ut
                                        non quam ut quod eius qui. Ipsum quia odit vero atque qui quibusdam amet. Occaecati
                                        sed est sint aut vitae molestiae voluptate vel</p>
                                </div>
                                <div class="col-lg-4 text-center order-1 order-lg-2">
                                    <img src="assets/img/departments-5.jpg" alt="" class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section><!-- /Tabs Section -->

    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Testimonials</h2>
            <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="swiper init-swiper" data-speed="600" data-delay="5000"
                data-breakpoints="{ &quot;320&quot;: { &quot;slidesPerView&quot;: 1, &quot;spaceBetween&quot;: 40 }, &quot;1200&quot;: { &quot;slidesPerView&quot;: 3, &quot;spaceBetween&quot;: 40 } }">
                <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 600,
              "autoplay": {
                "delay": 5000
              },
              "slidesPerView": "auto",
              "pagination": {
                "el": ".swiper-pagination",
                "type": "bullets",
                "clickable": true
              },
              "breakpoints": {
                "320": {
                  "slidesPerView": 1,
                  "spaceBetween": 40
                },
                "1200": {
                  "slidesPerView": 3,
                  "spaceBetween": 20
                }
              }
            }
          </script>
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="testimonial-item" "="">
                                                                                                                                                                                                                                                                                                                                                                                                                                                   <p>
                                                                                                                                                                                                                                                                                                                                                                                                                                                     <i class=" bi bi-quote quote-icon-left"></i>
                                                                                                                                                                                                                                                                                                                                                                                                                                                       <span>Proin iaculis purus consequat sessim donec porttitora entum susciAccusantium quam, ultricies eget id, nibh et. Maecen aliquam, risus at semper.</span>
                                                                                                                                                                                                                                                                                                                                                                                                                                                       <i class="bi bi-quote quote-icon-right"></i>
                                                                                                                                                                                                                                                                                                                                                                                                                                                    </p>
                                                                                                                                                                                                                                                                                                                                                                                                                                                    <img src="assets/img/testimonials/testimoclass="testimonial-img"
                            alt="">
                            <h3>Saul Goodman</h3>
                            <h4>Ceo &amp; Founder</h4>
                        </div>
                    </div><!-- End testimonial item -->
                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <p>
                                <i class="bi bi-quote quote-icon-left"></i>
                                <span>Export tempor illum tamen malis malis eraesse labore quem cillum quid malis quorum
                                    velvelit sunt aliqua noster fugiat irure amet lega</span>
                                <i class="bi bi-quote quote-icon-right"></i>
                            </p>
                            <img src="assets/img/testimonials/testimoclass="testimonial-img" alt="">
                            <h3>Sara Wilsson</h3>
                            <h4>Designer</h4>
                        </div>
                    </div><!-- End testimonial item -->
                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <p>
                                <i class="bi bi-quote quote-icon-left"></i>
                                <span>Enim nisi quem export duis laboremagna enim sint quorum nulla quem veniatempor labore
                                    quem eram duis noster aute amquis sint minim.</span>
                                <i class="bi bi-quote quote-icon-right"></i>
                            </p>
                            <img src="assets/img/testimonials/testimoclass="testimonial-img" alt="">
                            <h3>Jena Karlis</h3>
                            <h4>Store Owner</h4>
                        </div>
                    </div><!-- End testimonial item -->
                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <p>
                                <i class="bi bi-quote quote-icon-left"></i>
                                <span>Fugiat enim eram quae cillum dolornulla culpa multos export minim fugiat dolveniam
                                    ipsum anim magna sunt elit forelabore illum veniam.</span>
                                <i class="bi bi-quote quote-icon-right"></i>
                            </p>
                            <img src="assets/img/testimonials/testimoclass="testimonial-img" alt="">
                            <h3>Matt Brandon</h3>
                            <h4>Freelancer</h4>
                        </div>
                    </div><!-- End testimonial item -->
                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <p>
                                <i class="bi bi-quote quote-icon-left"></i>
                                <span>Quis quorum aliqua sint quem legam foirure aliqua veniam tempor noster venianulla
                                    illum cillum fugiat legam esse venianisi cillum quid.</span>
                                <i class="bi bi-quote quote-icon-right"></i>
                            </p>
                            <img src="assets/img/testimonials/testimoclass="testimonial-img" alt="">
                            <h3>John Larson</h3>
                            <h4>Entrepreneur</h4>
                        </div>
                    </div><!-- End testimonial item -->
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>

    </section><!-- /Testimonials Section -->

    <!-- Gallery Section -->
    <section id="gallery" class="gallery section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Gallery</h2>
            <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="swiper init-swiper">
                <script type="application/json" class="swiper-config">
                                                    {
                                                      "loop": true,
                                                      "speed": 600,
                                                      "autoplay": {
                                                        "delay": 5000
                                                      },
                                                      "slidesPerView": "auto",
                                                      "centeredSlides": true,
                                                      "pagination": {
                                                        "el": ".swiper-pagination",
                                                        "type": "bullets",
                                                        "clickable": true
                                                      },
                                                      "breakpoints": {
                                                        "320": {
                                                          "slidesPerView": 1,
                                                          "spaceBetween": 0
                                                        },
                                                        "768": {
                                                          "slidesPerView": 3,
                                                          "spaceBetween": 20
                                                        },
                                                        "1200": {
                                                          "slidesPerView": 5,
                                                          "spaceBetween": 20
                                                        }
                                                      }
                                                    }
                                                </script>
                <div class="swiper-wrapper align-items-center">
                    <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery"
                            href="assets/img/gallery/gallery-1.jpg"><img src="assets/img/gallery/gallery-1.jpg"
                                class="img-fluid" alt=""></a></div>
                    <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery"
                            href="assets/img/gallery/gallery-2.jpg"><img src="assets/img/gallery/gallery-2.jpg"
                                class="img-fluid" alt=""></a></div>
                    <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery"
                            href="assets/img/gallery/gallery-3.jpg"><img src="assets/img/gallery/gallery-3.jpg"
                                class="img-fluid" alt=""></a></div>
                    <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery"
                            href="assets/img/gallery/gallery-4.jpg"><img src="assets/img/gallery/gallery-4.jpg"
                                class="img-fluid" alt=""></a></div>
                    <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery"
                            href="assets/img/gallery/gallery-5.jpg"><img src="assets/img/gallery/gallery-5.jpg"
                                class="img-fluid" alt=""></a></div>
                    <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery"
                            href="assets/img/gallery/gallery-6.jpg"><img src="assets/img/gallery/gallery-6.jpg"
                                class="img-fluid" alt=""></a></div>
                    <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery"
                            href="assets/img/gallery/gallery-7.jpg"><img src="assets/img/gallery/gallery-7.jpg"
                                class="img-fluid" alt=""></a></div>
                    <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery"
                            href="assets/img/gallery/gallery-8.jpg"><img src="assets/img/gallery/gallery-8.jpg"
                                class="img-fluid" alt=""></a></div>
                </div>
                <div class="swiper-pagination"></div>
            </div>

        </div>

    </section><!-- /Gallery Section -->

    <!-- Faq Section -->
    <section id="faq" class="faq section light-background">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Frequently Asked Questions</h2>
            <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
        </div><!-- End Section Title -->

        <div class="container">

            <div class="row justify-content-center">

                <div class="col-lg-10" data-aos="fade-up" data-aos-delay="100">

                    <div class="faq-container">

                        <div class="faq-item">
                            <h3>Non consectetur a erat nam at lectus urna duis?</h3>
                            <div class="faq-content">
                                <p>Feugiat pretium nibh ipsum consequat. Tempus iaculis urna id volutpat lacus laoreet non
                                    curabitur gravida. Venenatis lectus magna fringilla urna porttitor rhoncus dolor purus
                                    non.</p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div><!-- End Faq item-->

                        <div class="faq-item">
                            <h3>Feugiat scelerisque varius morbi enim nunc faucibus?</h3>
                            <div class="faq-content">
                                <p>Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit
                                    laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec
                                    pretium. Est pellentesque elit ullamcorper dignissim. Mauris ultrices eros in cursus
                                    turpis massa tincidunt dui.</p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div><!-- End Faq item-->

                        <div class="faq-item">
                            <h3>Dolor sit amet consectetur adipiscing elit pellentesque?</h3>
                            <div class="faq-content">
                                <p>Eleifend mi in nulla posuere sollicitudin aliquam ultrices sagittis orci. Faucibus
                                    pulvinar elementum integer enim. Sem nulla pharetra diam sit amet nisl suscipit. Rutrum
                                    tellus pellentesque eu tincidunt. Lectus urna duis convallis convallis tellus. Urna
                                    molestie at elementum eu facilisis sed odio morbi quis</p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div><!-- End Faq item-->

                        <div class="faq-item">
                            <h3>Ac odio tempor orci dapibus. Aliquam eleifend mi in nulla?</h3>
                            <div class="faq-content">
                                <p>Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit
                                    laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec
                                    pretium. Est pellentesque elit ullamcorper dignissim. Mauris ultrices eros in cursus
                                    turpis massa tincidunt dui.</p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div><!-- End Faq item-->

                        <div class="faq-item">
                            <h3>Tempus quam pellentesque nec nam aliquam sem et tortor?</h3>
                            <div class="faq-content">
                                <p>Molestie a iaculis at erat pellentesque adipiscing commodo. Dignissim suspendisse in est
                                    ante in. Nunc vel risus commodo viverra maecenas accumsan. Sit amet nisl suscipit
                                    adipiscing bibendum est. Purus gravida quis blandit turpis cursus in</p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div><!-- End Faq item-->

                        <div class="faq-item">
                            <h3>Perspiciatis quod quo quos nulla quo illum ullam?</h3>
                            <div class="faq-content">
                                <p>Enim ea facilis quaerat voluptas quidem et dolorem. Quis et consequatur non sed in
                                    suscipit sequi. Distinctio ipsam dolore et.</p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div><!-- End Faq item-->

                    </div>

                </div><!-- End Faq Column-->

            </div>

        </div>

    </section><!-- /Faq Section -->

    <!-- Contact Section -->
    <section id="contact" class="contact section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Contact</h2>
            <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
        </div><!-- End Section Title -->

        <div class="mb-5" data-aos="fade-up" data-aos-delay="200">
            <iframe style="border:0; width: 100%; height: 370px;"
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3651.031270861464!2d90.39945221498153!3d23.87585498453127!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c43d69a81e0f%3A0xa8c1f79f144bd6b2!2sUttara%2C%20Dhaka!5e0!3m2!1sen!2sbd!4v1694949220097!5m2!1sen!2sbd"
                frameborder="0" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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
                                <p>U101 Adam Street, New Uttara, NU 535022</p>
                            </div>
                        </div><!-- End Info Item -->

                        <div class="col-md-6">
                            <div class="info-item d-flex flex-column justify-content-center align-items-center"
                                data-aos="fade-up" data-aos-delay="300">
                                <i class="bi bi-telephone"></i>
                                <h3>Call Us</h3>
                                <p>+12 3456 789 00</p>
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
                                <small id="charCount" class="text-muted">0 / 200 (200 left)</small>

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

    </section><!-- /Contact Section -->
@endsection
