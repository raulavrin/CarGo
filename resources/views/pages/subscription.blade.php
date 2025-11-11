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
        <div class="container-fluid header p-0">
            <div class="row g-0 align-items-center flex-column-reverse flex-md-row">
                <div class="col-md-6 p-5 mt-lg-5">
                    <h1 class="display-5 animated fadeIn mb-4">CarGo Pro Subscription</h1>
                    <nav aria-label="breadcrumb animated fadeIn">
                        <ol class="breadcrumb text-uppercase">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Pages</a></li>
                            <li class="breadcrumb-item text-body active" aria-current="page">Subscription</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 animated fadeIn">
                    <img class="img-fluid rounded-image" src="site/img/header.jpg" alt="">
                </div>
            </div>
        </div>
        <!-- Header End -->

        <!-- Subscription Plans Start -->
        <div class="container-xxl py-5">
            <div class="container">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if(session('info'))
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        {{ session('info') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 800px;">
                    <h1 class="mb-3 section-title">Unlock Premium Benefits with CarGo Pro</h1>
                    <p class="section-subtitle">Choose the perfect subscription plan to enhance your car rental experience with exclusive benefits and priority services.</p>
                </div>
                <div class="row g-4 justify-content-center">
                    <!-- Basic Plan -->
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="subscription-card text-center h-100 position-relative" style="border:1px solid #bfbfbf;border-radius:1rem;">
                            <div class="p-5">
                                <div class="mb-4">
                                    <h3 class="category-title mb-2">CarGo Basic</h3>
                                    <h2 class="text-primary mb-4">
                                        <span class="display-4 fw-bold">৳999</span>
                                        <span class="text-muted fs-5">/year</span>
                                    </h2>
                                </div>
                                <ul class="list-unstyled mb-4 text-start">
                                    <li class="mb-3"><i class="fa fa-check-circle text-primary me-2"></i> 10% discount on all rentals</li>
                                    <li class="mb-3"><i class="fa fa-check-circle text-primary me-2"></i> Priority customer support</li>
                                    <li class="mb-3"><i class="fa fa-check-circle text-primary me-2"></i> Free cancellation up to 24hrs</li>
                                    <li class="mb-3"><i class="fa fa-check-circle text-primary me-2"></i> Access to exclusive deals</li>
                                </ul>
                                @if(Auth::check())
                                    <form action="{{ route('subscription.initiate') }}" method="POST" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="plan" value="basic">
                                        <button type="submit" class="btn w-100 py-3 rounded-pill" style="border:1px solid #d9d9d9;color:#333;background:#f7f7f7;">Subscribe Now</button>
                                    </form>
                                @else
                                    <a href="{{ route('login') }}" class="btn w-100 py-3 rounded-pill" style="border:1px solid #d9d9d9;color:#333;background:#f7f7f7;">Login to Subscribe</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- Premium Plan (Featured) -->
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="subscription-card text-center h-100 position-relative featured-plan" style="border:3px solid #bfbfbf;border-radius:1rem;">
                            <div class="position-absolute top-0 start-50 translate-middle">
                                <span class="badge bg-primary px-3 py-2 rounded-pill">Most Popular</span>
                            </div>
                            <div class="p-5 mt-3">
                                <div class="mb-4">
                                    <h3 class="category-title mb-2">CarGo Premium</h3>
                                    <h2 class="text-primary mb-4">
                                        <span class="display-4 fw-bold">৳1,999</span>
                                        <span class="text-muted fs-5">/year</span>
                                    </h2>
                                </div>
                                <ul class="list-unstyled mb-4 text-start">
                                    <li class="mb-3"><i class="fa fa-check-circle text-primary me-2"></i> 15% discount on all rentals</li>
                                    <li class="mb-3"><i class="fa fa-check-circle text-primary me-2"></i> VIP customer support</li>
                                    <li class="mb-3"><i class="fa fa-check-circle text-primary me-2"></i> Free cancellation up to 48hrs</li>
                                    <li class="mb-3"><i class="fa fa-check-circle text-primary me-2"></i> Early access to new vehicles</li>
                                    <li class="mb-3"><i class="fa fa-check-circle text-primary me-2"></i> Free delivery & pickup</li>
                                    <li class="mb-3"><i class="fa fa-check-circle text-primary me-2"></i> Loyalty points program</li>
                                </ul>
                                @if(Auth::check())
                                    <form action="{{ route('subscription.initiate') }}" method="POST" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="plan" value="premium">
                                        <button type="submit" class="btn btn-primary w-100 py-3 rounded-pill">Subscribe Now</button>
                                    </form>
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-primary w-100 py-3 rounded-pill">Login to Subscribe</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- Pro Plan -->
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                        <div class="subscription-card text-center h-100 position-relative" style="border:1px solid #bfbfbf;border-radius:1rem;">
                            <div class="p-5">
                                <div class="mb-4">
                                    <h3 class="category-title mb-2">CarGo Pro</h3>
                                    <h2 class="text-primary mb-4">
                                        <span class="display-4 fw-bold">৳2,999</span>
                                        <span class="text-muted fs-5">/year</span>
                                    </h2>
                                </div>
                                <ul class="list-unstyled mb-4 text-start">
                                    <li class="mb-3"><i class="fa fa-check-circle text-primary me-2"></i> 20% discount on all rentals</li>
                                    <li class="mb-3"><i class="fa fa-check-circle text-primary me-2"></i> 24/7 dedicated support</li>
                                    <li class="mb-3"><i class="fa fa-check-circle text-primary me-2"></i> Free cancellation anytime</li>
                                    <li class="mb-3"><i class="fa fa-check-circle text-primary me-2"></i> Premium vehicle access</li>
                                    <li class="mb-3"><i class="fa fa-check-circle text-primary me-2"></i> Unlimited free delivery</li>
                                    <li class="mb-3"><i class="fa fa-check-circle text-primary me-2"></i> Concierge service</li>
                                    <li class="mb-3"><i class="fa fa-check-circle text-primary me-2"></i> Annual free rental day</li>
                                </ul>
                                @if(Auth::check())
                                    <form action="{{ route('subscription.initiate') }}" method="POST" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="plan" value="pro">
                                        <button type="submit" class="btn w-100 py-3 rounded-pill" style="border:1px solid #d9d9d9;color:#333;background:#f7f7f7;">Subscribe Now</button>
                                    </form>
                                @else
                                    <a href="{{ route('login') }}" class="btn w-100 py-3 rounded-pill" style="border:1px solid #d9d9d9;color:#333;background:#f7f7f7;">Login to Subscribe</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Subscription Plans End -->

        <!-- Footer Start -->
        <div class="container-fluid footer pt-5 mt-5 wow fadeIn footer-dark" data-wow-delay="0.1s">
            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-lg-3 col-md-6">
                        <h5 class="mb-4 footer-title">Get In Touch</h5>
                        <p class="mb-2 footer-text"><i class="fa fa-map-marker-alt me-3 text-primary"></i>123 Street, New York, USA</p>
                        <p class="mb-2 footer-text"><i class="fa fa-phone-alt me-3 text-primary"></i>+012 345 67890</p>
                        <p class="mb-2 footer-text"><i class="fa fa-envelope me-3 text-primary"></i>info@example.com</p>
                        <div class="d-flex pt-2">
                            <a class="btn btn-outline-light footer-social" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-light footer-social" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-light footer-social" href=""><i class="fab fa-youtube"></i></a>
                            <a class="btn btn-outline-light footer-social" href=""><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h5 class="mb-4 footer-title">Quick Links</h5>
                        <a class="footer-link" href="/about">About Us</a>
                        <a class="footer-link" href="/contact">Contact Us</a>
                        <a class="footer-link" href="">Our Services</a>
                        <a class="footer-link" href="">Privacy Policy</a>
                        <a class="footer-link" href="">Terms & Condition</a>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h5 class="mb-4 footer-title">Vehicle Gallery</h5>
                        <div class="row g-2 pt-2">
                            <div class="col-4">
                                <img class="img-fluid rounded-image-small bg-light p-1" src="site/img/car-1.jpg" alt="">
                            </div>
                            <div class="col-4">
                                <img class="img-fluid rounded-image-small bg-light p-1" src="site/img/car-2.jpg" alt="">
                            </div>
                            <div class="col-4">
                                <img class="img-fluid rounded-image-small bg-light p-1" src="site/img/car-3.jpg" alt="">
                            </div>
                            <div class="col-4">
                                <img class="img-fluid rounded-image-small bg-light p-1" src="site/img/car-4.jpg" alt="">
                            </div>
                            <div class="col-4">
                                <img class="img-fluid rounded-image-small bg-light p-1" src="site/img/car-5.jpg" alt="">
                            </div>
                            <div class="col-4">
                                <img class="img-fluid rounded-image-small bg-light p-1" src="site/img/car-6.jpg" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h5 class="mb-4 footer-title">Newsletter</h5>
                        <p class="footer-text">Stay updated with our latest offers and vehicle additions.</p>
                        <div class="position-relative mx-auto" style="max-width: 400px;">
                            <input class="form-control w-100 py-3 ps-4 pe-5 footer-newsletter-input" type="text" placeholder="Your email">
                            <button type="button" class="btn py-2 position-absolute top-0 end-0 mt-2 me-2 footer-newsletter-button">SignUp</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="copyright">
                    <div class="row">
                        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                            <span class="footer-text">&copy; <a class="border-bottom text-primary" href="#">CarRental</a>, All Right Reserved.</span>
                        </div>
                        <div class="col-md-6 text-center text-md-end">
                            <div class="footer-menu">
                                <a href="" class="footer-link" style="margin-right: 15px;">Home</a>
                                <a href="" class="footer-link" style="margin-right: 15px;">Cookies</a>
                                <a href="" class="footer-link" style="margin-right: 15px;">Help</a>
                                <a href="" class="footer-link">FQAs</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-lg-square back-to-top back-to-top-new rounded-circle"><i class="bi bi-arrow-up"></i></a>
    </div>

    @include('common.site.script')
</body>

</html>

