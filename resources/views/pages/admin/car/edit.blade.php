@extends('admin-master')
@section('main_content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Edit Vehicle</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="{{route("carUpdate")}}" method="post">
        @csrf
        <div class="card-body">
            <input type="hidden" name="id" value="{{$car->id}}">

            <div class="form-group">
                <label for="exampleInputEmail1">Image Url</label>
                <input type="text" name="image" value="{{$car->image}}" class="form-control" id="exampleInputEmail1"
                    placeholder="Enter image url">
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Vehicle Name</label>
                <input type="text" name="title" value="{{$car->title}}" class="form-control" id="exampleInputEmail1" placeholder="Enter vehicle name"
                    required>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Brand</label>
                <input type="text" name="brand" value="{{$car->brand ?? ''}}" class="form-control" id="exampleInputEmail1" placeholder="Enter brand (e.g., Toyota)">
            </div>

            <div class="form-group">
                <label>Select Listing</label>
                <select class="form-control" name="type">
                    <option selected = {{$car->type == "For Rent"}}>For Rent</option>
                    <option>For Sale</option>
                </select>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Daily Price</label>
                <input type="number" name="price" value="{{$car->price}}" class="form-control" id="exampleInputEmail1"
                    placeholder="Enter daily price">
            </div>

            <div class="form-group">
                <label>Select Vehicle Type</label>
                <select class="form-control" name="car_type">
                    <option selected = {{$car->car_type == "Sedan"}}>Sedan</option>
                    <option selected = {{$car->car_type == "SUV"}}>SUV</option>
                    <option selected = {{$car->car_type == "Hatchback"}}>Hatchback</option>
                    <option selected = {{$car->car_type == "Convertible"}}>Convertible</option>
                </select>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Pickup Location</label>
                <input type="text" name="address" value="{{$car->address}}" class="form-control" id="exampleInputEmail1"
                    placeholder="Enter pickup location">
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Seats</label>
                <input type="number" name="seats" value="{{$car->seats}}" class="form-control" id="exampleInputEmail1"
                    placeholder="Enter number of seats">
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Doors</label>
                <input type="number" name="doors" value="{{$car->doors}}" class="form-control" id="exampleInputEmail1"
                    placeholder="Enter number of doors">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Mileage (L/100km)</label>
                <input type="number" step="0.1" name="milage" value="{{$car->milage}}" class="form-control" id="exampleInputEmail1"
                    placeholder="Enter average mileage">
            </div>

            <div class="form-check">
                <input type="checkbox" name="isActive" {{$car->isActive == 1 ? "checked" : ""}} class="form-check-input" id="exampleCheck2">
                <label class="form-check-label" for="exampleCheck2">Is Active</label>
            </div>

        </div>


        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
</div>
@endsection

