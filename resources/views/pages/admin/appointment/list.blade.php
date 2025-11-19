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
                            <td>
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
                            <td>{{$appointment->car ? $appointment->car->title : 'Vehicle removed'}}</td>
                            <td>{{$appointment->message}}</td>
                            <td>
                                @if($appointment->status === 'approved')
                                    <span class="badge badge-success">Approved</span>
                                @elseif($appointment->status === 'declined')
                                    <span class="badge badge-danger">Declined</span>
                                @else
                                    <span class="badge badge-warning">Pending</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    @if($appointment->status === "declined")
                                        <a href="{{route("approveAppointment", $appointment->id)}}" 
                                           class="btn btn-sm btn-info" 
                                           title="Approve">
                                            <i class="fas fa-check"></i> Approve
                                        </a>
                                    @elseif($appointment->status === "approved")
                                        <a href="{{route("declineAppointment", $appointment->id)}}" 
                                           class="btn btn-sm btn-warning" 
                                           title="Decline">
                                            <i class="fas fa-times"></i> Decline
                                        </a>
                                    @else
                                        <a href="{{route("approveAppointment", $appointment->id)}}" 
                                           class="btn btn-sm btn-info" 
                                           title="Approve">
                                            <i class="fas fa-check"></i> Approve
                                        </a>
                                        <a href="{{route("declineAppointment", $appointment->id)}}" 
                                           class="btn btn-sm btn-warning" 
                                           title="Decline">
                                            <i class="fas fa-times"></i> Decline
                                        </a>
                                    @endif
                                    
                                    <a href="{{route("deleteAppointment", $appointment->id)}}" 
                                       class="btn btn-sm btn-danger" 
                                       onclick="return confirm('Are you sure you want to delete this appointment?')"
                                       title="Delete">
                                        <i class="fas fa-trash"></i> Delete
                                    </a>
                                </div>
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