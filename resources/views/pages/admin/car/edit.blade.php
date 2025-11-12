@extends('admin-master')
@section('main_content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Edit Vehicle</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="{{route("carUpdate")}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <input type="hidden" name="id" value="{{$car->id}}">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-group">
                <label for="imageUpload">Vehicle Image</label>
                
                @if($car->image)
                    <div class="mb-2">
                        <img src="{{ $car->image_url }}" alt="Current Image" style="max-width: 300px; max-height: 200px; border-radius: 8px; border: 2px solid #ddd;">
                        <p class="text-muted small mt-1">Current Image</p>
                    </div>
                @endif
                
                <div class="custom-file">
                    <input type="file" name="image" class="custom-file-input" id="imageUpload" accept="image/*" onchange="previewImage(this)">
                    <label class="custom-file-label" for="imageUpload">Choose new image</label>
                </div>
                <small class="form-text text-muted">Accepted formats: JPG, JPEG, PNG, GIF (Max: 2MB). Leave empty to keep current image.</small>
                
                <!-- Image Preview -->
                <div id="imagePreview" class="mt-3" style="display: none;">
                    <img id="preview" src="" alt="Image Preview" style="max-width: 300px; max-height: 200px; border-radius: 8px; border: 2px solid #ddd;">
                    <p class="text-muted small mt-1">New Image Preview</p>
                </div>
            </div>

            <div class="form-group">
                <label for="title">Vehicle Name</label>
                <input type="text" name="title" value="{{$car->title}}" class="form-control" id="title" placeholder="Enter vehicle name" required>
            </div>

            <div class="form-group">
                <label for="brand">Brand</label>
                <input type="text" name="brand" value="{{$car->brand ?? ''}}" class="form-control" id="brand" placeholder="Enter brand (e.g., Toyota)">
            </div>

            <div class="form-group">
                <label>Select Listing</label>
                <select class="form-control" name="type">
                    <option {{$car->type == "For Rent" ? "selected" : ""}}>For Rent</option>
                    <option {{$car->type == "For Sale" ? "selected" : ""}}>For Sale</option>
                </select>
            </div>

            <div class="form-group">
                <label for="price">Daily Price</label>
                <input type="number" name="price" value="{{$car->price}}" class="form-control" id="price" placeholder="Enter daily price">
            </div>

            <div class="form-group">
                <label>Select Vehicle Type</label>
                <select class="form-control" name="car_type">
                    <option {{$car->car_type == "Sedan" ? "selected" : ""}}>Sedan</option>
                    <option {{$car->car_type == "SUV" ? "selected" : ""}}>SUV</option>
                    <option {{$car->car_type == "Hatchback" ? "selected" : ""}}>Hatchback</option>
                    <option {{$car->car_type == "Convertible" ? "selected" : ""}}>Convertible</option>
                </select>
            </div>

            <div class="form-group">
                <label for="address">Pickup Location</label>
                <input type="text" name="address" value="{{$car->address}}" class="form-control" id="address" placeholder="Enter pickup location">
            </div>

            <div class="form-group">
                <label for="seats">Seats</label>
                <input type="number" name="seats" value="{{$car->seats}}" class="form-control" id="seats" placeholder="Enter number of seats">
            </div>

            <div class="form-group">
                <label for="doors">Doors</label>
                <input type="number" name="doors" value="{{$car->doors}}" class="form-control" id="doors" placeholder="Enter number of doors">
            </div>
            
            <div class="form-group">
                <label for="milage">Mileage (L/100km)</label>
                <input type="number" step="0.1" name="milage" value="{{$car->milage}}" class="form-control" id="milage" placeholder="Enter average mileage">
            </div>

            <div class="form-check">
                <input type="checkbox" name="isActive" {{$car->isActive == 1 ? "checked" : ""}} class="form-check-input" id="isActive">
                <label class="form-check-label" for="isActive">Is Active</label>
            </div>
        </div>

        <!-- /.card-body -->
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
</div>

<script>
function previewImage(input) {
    const preview = document.getElementById('preview');
    const previewDiv = document.getElementById('imagePreview');
    const fileLabel = document.querySelector('.custom-file-label');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            preview.src = e.target.result;
            previewDiv.style.display = 'block';
        }
        
        reader.readAsDataURL(input.files[0]);
        fileLabel.textContent = input.files[0].name;
    } else {
        previewDiv.style.display = 'none';
        fileLabel.textContent = 'Choose new image';
    }
}
</script>
@endsection