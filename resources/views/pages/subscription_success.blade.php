<!DOCTYPE html>
<html lang="en">

@include('common.site.head')

<body class="bg-light">
	<div class="container-xxl p-0 bg-light">
		@include('common.site.navbar')

		<div class="container-xxl py-5">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-lg-8">
						<div class="bg-white rounded-4 p-5 text-center shadow-sm">
							<div class="mb-4">
								<i class="fa fa-check-circle text-success" style="font-size: 64px;"></i>
							</div>
							<h1 class="mb-3">Payment Successful!</h1>
							<p class="text-muted mb-4">
								@if(session('success'))
									{{ session('success') }}
								@else
									Your subscription is now active. Thank you for choosing CarGo!
								@endif
							</p>
							
							<div class="mb-4">
								<p class="text-muted">You're now a CarGo Pro member and can enjoy exclusive benefits:</p>
								<ul class="list-unstyled text-start d-inline-block">
									<li class="mb-2"><i class="fa fa-check text-success me-2"></i> Premium discounts on all rentals</li>
									<li class="mb-2"><i class="fa fa-check text-success me-2"></i> Priority customer support</li>
									<li class="mb-2"><i class="fa fa-check text-success me-2"></i> Exclusive deals and offers</li>
									<li class="mb-2"><i class="fa fa-check text-success me-2"></i> Early access to new vehicles</li>
								</ul>
							</div>

							<div class="d-flex gap-3 justify-content-center flex-wrap">
								<a href="{{ route('home') }}" class="btn btn-primary py-3 px-5 rounded-pill">
									<i class="fa fa-home me-2"></i>Go to Home
								</a>
								<a href="{{ route('myAppointments') }}" class="btn py-3 px-5 rounded-pill" style="border:1px solid #d9d9d9;color:#333;background:#f7f7f7;">
									<i class="fa fa-calendar me-2"></i>View My Bookings
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

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
								<img class="img-fluid rounded-image-small bg-light p-1" src="/site/img/car-1.jpg" alt="">
							</div>
							<div class="col-4">
								<img class="img-fluid rounded-image-small bg-light p-1" src="/site/img/car-2.jpg" alt="">
							</div>
							<div class="col-4">
								<img class="img-fluid rounded-image-small bg-light p-1" src="/site/img/car-3.jpg" alt="">
							</div>
							<div class="col-4">
								<img class="img-fluid rounded-image-small bg-light p-1" src="/site/img/car-4.jpg" alt="">
							</div>
							<div class="col-4">
								<img class="img-fluid rounded-image-small bg-light p-1" src="/site/img/car-5.jpg" alt="">
							</div>
							<div class="col-4">
								<img class="img-fluid rounded-image-small bg-light p-1" src="/site/img/car-6.jpg" alt="">
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