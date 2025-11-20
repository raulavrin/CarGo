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
								<a href="{{ route('userProfile') }}" class="btn py-3 px-5 rounded-pill" style="border:1px solid #d9d9d9;color:#333;background:#f7f7f7;">
									<i class="fa fa-user me-2"></i>View Profile
								</a>
								<a href="{{ route('myAppointments') }}" class="btn py-3 px-5 rounded-pill" style="border:1px solid #d9d9d9;color:#333;background:#f7f7f7;">
									<i class="fa fa-calendar me-2"></i>My Bookings
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>


		<!-- Back to Top -->
		<a href="#" class="btn btn-lg btn-lg-square back-to-top back-to-top-new rounded-circle"><i class="bi bi-arrow-up"></i></a>
	</div>

	@include('common.site.script')
</body>

</html>