<!DOCTYPE html>
<html lang="en">

@include('common.site.head')

<body>

    <!-- Contact Start -->
    <div class="container-xxl bg-white p-0">
        @include('common.site.navbar')
        <div class="container-xxl py-5 bg-white">
            <div class="container ">
                <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                    <h1 class="mb-3">Book Your Car</h1>
                    <p>Get in touch with us by filling out the form below. Our team will get back to you shortly. Thank you for choosing CarGo!</p>
                </div>
                <div class="row g-4">
                    <div class="col-12">
                        <div class="row gy-4">
                            <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay="0.1s">
                                <div class="bg-light rounded p-3">
                                    <div class="d-flex align-items-center bg-white rounded p-3"
                                        style="border: 1px dashed rgba(0, 185, 142, .3)">
                                        <div class="icon me-3" style="width: 45px; height: 45px;">
                                            <i class="fa fa-map-marker-alt text-primary"></i>
                                        </div>
                                        <span>21,Sonadanga Main Road, Khulna</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay="0.3s">
                                <div class="bg-light rounded p-3">
                                    <div class="d-flex align-items-center bg-white rounded p-3"
                                        style="border: 1px dashed rgba(0, 185, 142, .3)">
                                        <div class="icon me-3" style="width: 45px; height: 45px;">
                                            <i class="fa fa-envelope-open text-primary"></i>
                                        </div>
                                        <span>admin@university.edu</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay="0.5s">
                                <div class="bg-light rounded p-3">
                                    <div class="d-flex align-items-center bg-white rounded p-3"
                                        style="border: 1px dashed rgba(0, 185, 142, .3)">
                                        <div class="icon me-3" style="width: 45px; height: 45px;">
                                            <i class="fa fa-phone-alt text-primary"></i>
                                        </div>
                                        <span>+880-1712345678</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="wow fadeInUp" data-wow-delay="0.5s">

                            <form action="{{route("appointmentBooking")}}" method="POST">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" name="name" class="form-control" id="name"
                                                placeholder="Your Name">
                                            <label for="name">Your Name</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="email" name="email" class="form-control" id="email"
                                                placeholder="Your Email">
                                            <label for="email">Your Email</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" name="phone" class="form-control" id="phone"
                                                placeholder="Your Phone">
                                            <label for="phone">Your Phone</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="date" name="date" class="form-control" id="date"
                                                placeholder="Pickup Date">
                                            <label for="date">Pickup Date</label>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-floating">
                                            <select name="property" id="property" class="form-control" placeholder="Select Vehicle">
                                                @foreach($properties as $property)
                                                    <option value="{{$property->id}}">{{$property->title}}</option>
                                                @endforeach
                                            </select>
                                            <label for="property">Select Vehicle</label>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-floating">
                                            <textarea class="form-control" name="notes"
                                                placeholder="Leave a message here" id="message"
                                                style="height: 150px"></textarea>
                                            <label for="message">Notes</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        @if(Auth::user())
                                            <button class="btn btn-primary w-100 py-3" type="submit">Confirm Booking</button>
                                        @else
                                            <a href="/login" class="btn btn-primary w-100 py-3" type="submit">Login to Book</a>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Contact End -->

    </div>
</body>

</html>