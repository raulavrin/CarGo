@extends('admin-master')
@section('main_content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Add Vehicle</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="/add-car" method="post">
        @csrf
        <div class="card-body">
            <!-- <div class="form-group">
                                    <label for="exampleInputFile">Upload Image</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="exampleInputFile">
                                            <label class="custom-file-label" for="exampleInputFile">Choose image</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Upload</span>
                                        </div>
                                    </div>
                                </div> -->

            <div class="form-group">
                <label for="exampleInputEmail1">Image Url</label>
                <input type="text" name="image" class="form-control" id="exampleInputEmail1"
                    placeholder="Enter image url">
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Vehicle Name</label>
                <input type="text" name="title" class="form-control" id="exampleInputEmail1" placeholder="Enter vehicle name"
                    required>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Brand</label>
                <input type="text" name="brand" class="form-control" id="exampleInputEmail1" placeholder="Enter brand (e.g., Toyota)">
            </div>

            <div class="form-group">
                <label>Select Listing</label>
                <select class="form-control" name="type">
                    <option>For Rent</option>
                    <option>For Sale</option>
                </select>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Prize / Monthly rent</label>
                <input type="number" name="price" class="form-control" id="exampleInputEmail1"
                    placeholder="Enter price or monthly rent">
            </div>

            <div class="form-group">
                <label>Select Vehicle Type</label>
                <select class="form-control" name="car_type">
                    <option>Sedan</option>
                    <option>SUV</option>
                    <option>Hatchback</option>
                    <option>Convertible</option>
                </select>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Pickup Location</label>
                <input type="text" name="address" class="form-control" id="exampleInputEmail1"
                    placeholder="Enter pickup location">
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Seats</label>
                <input type="number" name="seats" class="form-control" id="exampleInputEmail1"
                    placeholder="Enter number of seats">
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Doors</label>
                <input type="number" name="doors" class="form-control" id="exampleInputEmail1"
                    placeholder="Enter number of doors">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Mileage (L/100km)</label>
                <input type="number" step="0.1" name="milage" class="form-control" id="exampleInputEmail1"
                    placeholder="Enter average mileage">
            </div>

            <div class="form-check">
                <input type="checkbox" name="isActive" class="form-check-input" id="exampleCheck2">
                <label class="form-check-label" for="exampleCheck2">Is Active</label>
            </div>

        </div>


        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
@endsection

