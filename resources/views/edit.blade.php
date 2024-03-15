@extends('layout.base')
@section('title', 'Edit')
@section('content')

<div class="container mt-5">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            Users Info
            <a href="{{ url('admindashboard') }}" class="btn btn-secondary">Back</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <form id="updateForm" action="{{ url('admindashboard/'.$data->id.'/edit' )}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    @if(session()->has('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session()->has('status'))
                        <div class="alert alert-info">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="mb-3">
                        <label>User ID</label>
                        <input type="text" name="user_id" id="user_id" class="form-control" value="{{$data->id}}" readonly style="background-color: #f8f9fa;" />
                    </div>
                    <div class="mb-3">
                        <label>Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{$data->name}}"/>
                    </div>
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{$data->email}}"/>
                    </div>
                    <div class="mb-3">
                        <label>Phone Number</label>
                        <input type="text" name="phonenum" id="phonenum" class="form-control" value="{{$data->phonenum}}"/>
                    </div>
                    <div class="mb-3">
                        <label>Address</label>
                        <input type="text" name="address" id="address" class="form-control" value="{{$data->address}}"/>
                    </div>
                    <div class="mb-3">
                        <label>Upload Image (.png, .jpeg, .jpg & .webp format only)</label>
                        <input type="file" name="image" id="imageInput" class="form-control"/>
                        <img id="croppedImage" style="max-width: 100%; height: auto;">
                    </div>
                    <div class="mb-3">
                        <button type="submit" onclick="updateUser()" class="btn btn-primary">Update</button>
                    </div>
                </form>

                <!-- Display User Image and Details -->
                <hr>
                <h4>User Details:</h4>
                <div class="text-center"> <!-- Center aligning this section -->
                    <img src="{{ asset($data->image) }}" id="userImage" style="width: 150px; height: 150px; object-fit: cover; border-radius: 50%;" alt="{{$data->name}}">
                    <p>Name: <span id="userName">{{$data->name}}</span></p>
                    <p>Email: <span id="userEmail">{{$data->email}}</span></p>
                    <p>Phone Number: <span id="userPhone">{{$data->phonenum}}</span></p>
                </div>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var cropper = null;
    var imageInput = document.getElementById('imageInput');
    var croppedImage = document.getElementById('croppedImage');

    imageInput.addEventListener('change', function() {
        var file = this.files[0];
        var reader = new FileReader();

        reader.onload = function(e) {
            if (cropper) {
                cropper.destroy();
            }

            croppedImage.src = e.target.result;
            cropper = new Cropper(croppedImage, {
                aspectRatio: 1, // Set aspect ratio as needed
                viewMode: 1, // Set view mode as needed
                guides: true,
                autoCropArea: 0.8,
                responsive: true
            });
        };

        reader.readAsDataURL(file);
    });

    function updateUser() {
        var formData = new FormData(document.getElementById('updateForm'));
        
        $.ajax({
            url: "{{ url('admindashboard/'.$data->id.'/edit' )}}",
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                // Update user details in real-time
                $('#userImage').attr('src', response.image);
                $('#userName').text(response.name);
                $('#userEmail').text(response.email);
                $('#userPhone').text(response.phonenum);
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });
    }
</script>

@endsection