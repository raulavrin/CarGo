<!DOCTYPE html>
<html lang="en">

@include('common.site.head')

<body class="bg-light">
    <div class="container-xxl p-0 bg-light">
        <!-- Spinner Start -->
        <div id="spinner" class="show position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center bg-light">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <!-- Navbar Start -->
        @include('common.site.navbar')
        <!-- Navbar End -->

        <!-- Header Start -->
        <div class="container-fluid header bg-white p-0">
            <div class="row g-0 align-items-center flex-column-reverse flex-md-row">
                <div class="col-md-6 p-5 mt-lg-5">
                    <h1 class="display-5 animated fadeIn mb-4">Contact Us</h1>
                    <nav aria-label="breadcrumb animated fadeIn">
                        <ol class="breadcrumb text-uppercase">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Pages</a></li>
                            <li class="breadcrumb-item text-body active" aria-current="page">Contact</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 animated fadeIn">
                    <img class="img-fluid rounded-image" src="site/img/header.jpg" alt="">
                </div>
            </div>
        </div>
        <!-- Header End -->

        <!-- Contact Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                    <h1 class="mb-3 section-title">Get In Touch</h1>
                    <p class="section-subtitle">Have questions or need assistance? We're here to help! Reach out to us through any of the channels below.</p>
                </div>
                <div class="row g-4">
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="category-card text-center h-100">
                            <div class="d-inline-flex align-items-center justify-content-center bg-primary text-white rounded-circle mb-4" style="width: 75px; height: 75px;">
                                <i class="fa fa-map-marker-alt fa-2x"></i>
                            </div>
                            <h5 class="category-title mb-2">Visit Us</h5>
                            <p class="category-count mb-0">21,Sonadanga Main Road, Khulna</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="category-card text-center h-100">
                            <div class="d-inline-flex align-items-center justify-content-center bg-primary text-white rounded-circle mb-4" style="width: 75px; height: 75px;">
                                <i class="fa fa-phone-alt fa-2x"></i>
                            </div>
                            <h5 class="category-title mb-2">Call Us</h5>
                            <p class="category-count mb-0">+880-1712345678</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                        <div class="category-card text-center h-100">
                            <div class="d-inline-flex align-items-center justify-content-center bg-primary text-white rounded-circle mb-4" style="width: 75px; height: 75px;">
                                <i class="fa fa-envelope fa-2x"></i>
                            </div>
                            <h5 class="category-title mb-2">Email Us</h5>
                            <p class="category-count mb-0">admin@university.edu</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contact Info End -->

        <!-- Contact Form Start -->
        @include('sweetalert::alert')
        <div class="container-xxl py-5">
            <div class="container">
                <div class="row g-5">
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                        <div class="section-container p-5">
                            <h1 class="mb-4 section-title">Send Us a Message</h1>
                            <p class="section-subtitle mb-4">Fill out the form below and we'll get back to you as soon as possible.</p>
                            <form action="{{ route('contactStore') }}" method="POST">
                             @csrf
                             @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fa fa-check-circle me-2"></i>{{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                                            <label for="name">Your Name</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="email" name="email" class="form-control" id="email" placeholder="Your Email" required>
                                            <label for="email">Your Email</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="text" name="subject" class="form-control" id="subject" placeholder="Subject" required>
                                            <label for="subject">Subject</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea class="form-control" name="message" placeholder="Leave a message here" id="message" style="height: 150px" required></textarea>
                                            <label for="message">Message</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary py-3 px-5" type="submit">Send Message</button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                        <div class="section-container h-100">
                            <iframe class="position-relative rounded w-100 h-100" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3677.427388955636!2d89.53733567590797!3d22.823672123720304!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39ff9b952e7b24af%3A0xae7655bcfe3f6c35!2sAppstick!5e0!3m2!1sen!2sbd!4v1756125388178!5m2!1sen!2sbd" frameborder="0" style="min-height: 450px; border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contact Form End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-lg-square back-to-top back-to-top-new rounded-circle"><i class="bi bi-arrow-up"></i></a>
    </div>

    @include('common.site.script')
</body>

</html>

