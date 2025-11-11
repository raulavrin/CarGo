@extends('admin-master')
@section('main_content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Booking List</h3>

            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>Booking User</th>
                            <th>System User</th>
                            <th>Date</th>
                            <th>Vehicle Info</th>
                            <th>Message</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($appointments as $appointment)
                        <tr>
                            <td >
                                <p class="mb-0">Name: {{$appointment->name}}</p>
                                <p class="mb-0">Email: {{$appointment->email}}</p>
                                <p class="mb-0">Phone: {{$appointment->phone}}</p>
                            </td>
                            <td>
                                @if($appointment->user)
                                    <p class="mb-0">Name: {{$appointment->user->name}}</p>
                                    <p class="mb-0">Email: {{$appointment->user->email}}</p>
                                    <p class="mb-0">Phone: {{$appointment->user->phone}}</p>
                                @else
                                    <p class="text-muted mb-0">User account deleted</p>
                                @endif
                            </td>
                            <td>{{$appointment->date}}</td>
                            <td>{{$appointment->property ? $appointment->property->title : 'Vehicle removed'}}</td>
                            <td>{{$appointment->message}}</td>
                            <td>{{$appointment->status}}</td>
                            <td>
                                @if($appointment->status === "declined")
                                <a href="{{route("approveAppointment", $appointment->id)}}" class="btn btn-info">Approve</a>
                                @elseif($appointment->status === "approved")
                                <a href="{{route("declineAppointment", $appointment->id)}}" class="btn btn-danger">Decline</a>
                                @else
                                <a href="{{route("approveAppointment", $appointment->id)}}" class="btn btn-info">Approve</a>
                                <a href="{{route("declineAppointment", $appointment->id)}}" class="btn btn-danger">Decline</a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection