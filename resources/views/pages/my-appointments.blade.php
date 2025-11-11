<!DOCTYPE html>
<html lang="en">

@include('common.site.head')

<body>

    <!-- Contact Start -->
    <div class="container-xxl bg-white p-0">
        @include('common.site.navbar')
        <div class="container-xxl py-5 bg-white">
            <div class="container ">
                <div class=" mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s">
                    <h1 class="mb-3 text-center">My Bookings</h1>

                    <div class="table-responsive shadow-sm rounded mt-5">
                        <table class="table table-hover align-middle table-striped">
                            <thead class="table-primary">
                                <tr>
                                    <th scope="col">Booking User</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Vehicle Info</th>
                                    <th scope="col">Message</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($myAppointments as $appointment)
                                <tr>
                                    <td>
                                        <p class="mb-0">Name: {{$appointment->name}}</p>
                                        <p class="mb-0">Email: {{$appointment->email}}</p>
                                        <p class="mb-0">Phone: {{$appointment->phone}}</p>
                                    </td>
                                    <td>{{$appointment->date}}</td>
                                    <td>
                                        <p class="mb-0">Name: {{$appointment->property->title}}</p>
                                        <p class="mb-0">Price: ${{$appointment->property->price}}</p>
                                        <p class="mb-0">Address: {{$appointment->property->address}}</p>
                                    </td>
                                    <td>{{$appointment->message}}</td>
                                    <td>
                                        @if($appointment->status === "approved")
                                        <span class="badge bg-success">Approved</span>
                                        @elseif($appointment->status === "declined")
                                        <span class="badge bg-danger">Declined</span>
                                        @else<span class="badge bg-warning">Pending</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
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