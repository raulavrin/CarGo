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
        <div class="container-fluid p-0 hero-section">
            <div class="row g-0 align-items-center flex-column-reverse flex-md-row">
                <div class="col-md-6 p-5 mt-lg-5">
                    <h1 class="display-5 animated fadeIn mb-4 hero-title">Find The <span class="text-primary">Perfect Car</span> For Your Journey</h1>
                    <p class="animated fadeIn mb-4 pb-2 hero-subtitle">Discover the perfect vehicle for your next adventure. Quality cars, competitive prices, and exceptional service.</p>
                    <a href="#results" class="btn btn-primary py-3 px-5 me-3 animated fadeIn rounded-pill">Browse Cars</a>
                    <a href="#subscription" class="btn py-3 px-5 animated fadeIn rounded-pill" style="border:1px solid #d9d9d9;color:#333;background:#f7f7f7;">View Plans</a>
                </div>
                <div class="col-md-6 animated fadeIn p-4">
                    <div class="owl-carousel header-carousel rounded-5 shadow-lg overflow-hidden" style="border-radius: 20px;">
                        <div class="owl-carousel-item">
                            <img class="img-fluid w-100" src="site/img/carousel-1.jpg" alt="Car Rental" style="height: 500px; object-fit: cover; border-radius: 20px;">
                        </div>
                        <div class="owl-carousel-item">
                            <img class="img-fluid w-100" src="site/img/carousel-2.jpg" alt="Car Rental" style="height: 500px; object-fit: cover; border-radius: 20px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header End -->

        <!-- Category Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                    <h1 class="mb-3 section-title">Popular Vehicle Types</h1>
                    <p class="section-subtitle">Choose from our most popular vehicle categories for your next rental</p>
                </div>
                <div class="row g-4">
                    @php
                        $categoryIcons = [
                            'Sedan' => 'sedan.png',
                            'SUV' => 'suv.png',
                            'Hatchback' => 'hatch.png',
                            'Convertible' => 'conv.png',
                            'Truck' => 'truck.png',
                            'Van' => 'van.png'
                        ];
                        
                        $categories = \App\Models\Car::where('isActive', true)
                            ->select('car_type', \DB::raw('count(*) as count'))
                            ->groupBy('car_type')
                            ->orderBy('count', 'desc')
                            ->get();
                        
                        $delay = 0.1;
                    @endphp
                    
                    @forelse($categories as $category)
                        <div class="col-lg-4 col-sm-6 wow fadeInUp" data-wow-delay="{{ $delay }}s">
                            <a class="cat-item d-block text-center category-card" href="{{ route('home') }}?vehicle_type={{ $category->car_type }}#results">
                                <div class="rounded-4 p-4">
                                    <div class="icon mb-3">
                                        <img class="img-fluid" src="site/img/{{ $categoryIcons[$category->car_type] ?? 'conv.png' }}" alt="Icon">
                                    </div>
                                    <h6 class="category-title">{{ $category->car_type }}</h6>
                                    <span class="category-count">{{ $category->count }} {{ Str::plural('Car', $category->count) }}</span>
                                </div>
                            </a>
                        </div>
                        @php $delay += 0.2; @endphp
                    @empty
                        <div class="col-12 text-center">
                            <p class="text-muted">No vehicle categories available at the moment.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
        <!-- Category End -->


        <!-- CarGo Pro Subscription Start -->
        <div class="container-xxl py-5" id="subscription">
            <div class="container">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fa fa-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fa fa-exclamation-circle me-2"></i>{{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if(session('info'))
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <i class="fa fa-info-circle me-2"></i>{{ session('info') }}
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
        <!-- CarGo Pro Subscription End -->


        <!-- Vehicle List Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="row g-0 gx-5 align-items-end mb-4">
                    <div class="col-lg-6">
                        <div class="text-start mx-auto wow slideInLeft" data-wow-delay="0.1s">
                            <h1 class="mb-3 section-title">Featured Vehicles</h1>
                            <p class="section-subtitle">Discover our premium selection of well-maintained vehicles ready for your next journey.</p>
                        </div>
                    </div>
                </div>

                <!-- Search Bar -->
                <div class="mb-5 wow fadeIn search-container" data-wow-delay="0.1s" id="search">
                    <div class="row g-2">
                        <form action="{{ route('home') }}#results" method="get" class="w-100">
                            <div class="row g-2">
                                <div class="col-md-10">
                                    <div class="row g-2">
                                        <div class="col-md-4">
                                            <input type="text" name="q" value="{{ request('q') }}" class="form-control border-0 py-3 search-input" placeholder="Search car, brand or model">
                                        </div>
                                        <div class="col-md-4">
                                            <select name="vehicle_type" class="form-select border-0 py-3 search-input">
                                                <option value="" {{ request('vehicle_type') == '' ? 'selected' : '' }}>Vehicle Type</option>
                                                @if(!empty($types) && $types->count())
                                                    @foreach($types as $t)
                                                        <option value="{{ $t }}" {{ request('vehicle_type') == $t ? 'selected' : '' }}>{{ $t }}</option>
                                                    @endforeach
                                                @else
                                                    <option value="Sedan" {{ request('vehicle_type') == 'Sedan' ? 'selected' : '' }}>Sedan</option>
                                                    <option value="SUV" {{ request('vehicle_type') == 'SUV' ? 'selected' : '' }}>SUV</option>
                                                    <option value="Hatchback" {{ request('vehicle_type') == 'Hatchback' ? 'selected' : '' }}>Hatchback</option>
                                                    <option value="Convertible" {{ request('vehicle_type') == 'Convertible' ? 'selected' : '' }}>Convertible</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn w-100 py-3 search-button">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Search Bar End -->

                <div id="results">
                    <div class="p-0">
                        <div class="row g-4">
                            @foreach($cars as $car)
                                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                                    <div class="car-item vehicle-card">
                                        <div class="position-relative overflow-hidden">
                                            <a href="{{ route('getAppointment') }}?car_id={{ $car->id }}">
                                                <img class="img-fluid vehicle-image" src="{{ $car->image_url }}" alt="{{ $car->title }}">
                                            </a>
                                            <div class="rounded-pill text-white position-absolute start-0 top-0 m-4 py-1 px-3 bg-primary">{{$car->type}}</div>
                                            <div class="bg-white rounded-top position-absolute start-0 bottom-0 mx-4 pt-1 px-3 text-primary">{{$car->car_type}}</div>
                                        </div>
                                        <div class="p-4 pb-0">
                                            <h5 class="mb-3 vehicle-price">৳{{ $car->price }}{{ strtolower($car->type) == 'for rent' ? '/Month' : '' }}</h5>
                                            <a class="d-block h5 mb-2 vehicle-title" href="{{ route('getAppointment') }}?car_id={{ $car->id }}">{{$car->title}}</a>
                                            <p class="vehicle-location"><i class="fa fa-map-marker-alt me-2 text-primary"></i>{{$car->address}}</p>
                                        </div>
                                        <div class="d-flex border-top vehicle-feature">
                                            <small class="flex-fill text-center border-end py-2 vehicle-feature"><i class="fa fa-car-side me-2 text-primary"></i>{{$car->seats}} Seats</small>
                                            <small class="flex-fill text-center border-end py-2 vehicle-feature"><i class="fa fa-cog me-2 text-primary"></i>{{$car->doors}} Doors</small>
                                            <small class="flex-fill text-center py-2 vehicle-feature"><i class="fa fa-gas-pump me-2 text-primary"></i>{{$car->milage}} L/100km</small>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Vehicle List End -->


        <!-- Call to Action Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="cta-container">
                    <div class="cta-inner">
                        <div class="row g-5 align-items-center">
                            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                                <img class="img-fluid rounded-image w-100" src="site/img/call-to-action.jpg" alt="">
                            </div>
                            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                                <div class="mb-4">
                                    <h1 class="mb-3 cta-title">Ready to Book Your Perfect Car?</h1>
                                    <p class="cta-text">Get in touch with our rental specialists to find the ideal vehicle for your needs. We're here to help you every step of the way.</p>
                                </div>
                                <a href="/contact" class="btn cta-button-primary py-3 px-4 me-2 rounded-pill"><i class="fa fa-phone-alt me-2"></i>Call Us</a>
                                <a href="/get-appointment" class="btn cta-button-secondary py-3 px-4 rounded-pill"><i class="fa fa-calendar-alt me-2"></i>Book Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Call to Action End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-lg-square back-to-top back-to-top-new rounded-circle"><i class="bi bi-arrow-up"></i></a>
    </div>

    @include('common.site.script')
</body>

</html>