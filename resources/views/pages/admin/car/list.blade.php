@extends('admin-master')
@section('main_content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Vehicle List</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Vehicle</th>
                            <th>Listing</th>
                            <th>Price</th>
                            <th>Vehicle Type</th>
                            <th>Pickup Location</th>
                            <th>Seats</th>
                            <th>Doors</th>
                            <th>Mileage</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $car)
                        <tr>
                            <td>{{$car->id}}</td>
                            <td>
                                <img src="{{$car->image_url}}" height="64px" alt="{{$car->title}}" style="object-fit: cover; border-radius: 4px;">
                            </td>
                            <td>{{$car->title}}</td>
                            <td>{{$car->type}}</td>
                            <td>
                                ৳{{$car->price}}{{ strtolower($car->type) == 'for rent' ? '/month' : '' }}
                            </td>
                            <td>{{$car->car_type}}</td>
                            <td>{{$car->address}}</td>
                            <td>{{$car->seats}}</td>
                            <td>{{$car->doors}}</td>
                            <td>{{$car->milage}}</td>
                            <td class="{{$car->isActive ? "text-success" : "text-danger"}}">{{$car->isActive ? "Active" : "Inactive"}}</td>
                            <td>
                                <a href="{{route("editCar", $car->id)}}" class="btn btn-sm btn-primary" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="{{route("carDelete", $car->id)}}" 
                                   class="btn btn-sm btn-danger ml-1" 
                                   onclick="return confirm('Are you sure you want to delete this vehicle?')"
                                   title="Delete">
                                    <i class="fas fa-trash"></i>
                                </a>
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