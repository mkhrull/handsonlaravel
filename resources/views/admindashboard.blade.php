@extends('layout.base')
@section('title', 'Dashboard')
@section('content')

<div class="container mt-5">
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
    <div class="row mb-3">
        <div class="col">
            <div class="d-flex align-items-center">
                <div style="width: 100px; height: 100px; border-radius: 50%; overflow: hidden; margin-right: 10px; margin-bottom: 20px;">
                    <img src="{{ asset(Auth::user()->image) }}" style="width: 100%; height: 100%; object-fit: cover;" alt="User Image">
                </div>
                <h3>Hi, {{ Auth::user()->name }}.</h3>
                <a href="{{ url('admindashboard/'.Auth::user()->id.'/edit') }}" class="btn btn-secondary ms-2">Profile</a>
            </div>
        </div>
    </div>
    <div class="card">
    <div class="card-header">
        List of Users
        <div class="float-end">
            <a href="{{ route('createuser') }}" class="btn btn-success">Create New User</a>
            <button onclick="printTable()" class="btn btn-primary ms-2">Print/Export</button>
        </div>
    </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="userTable" class="table table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Address</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td style="max-width: 100px;">
                                <img src="{{ asset($item->image) }}" style="max-width: 100%; height: auto;" alt="{{ $item->name }} Image">
                            </td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->phonenum }}</td>
                            <td>{{ $item->address }}</td>
                            <td>
                                <a href="{{ url('admindashboard/'.$item->id.'/edit') }}" class="btn btn-primary">Edit</a>
                                <a href="{{ url('admindashboard/'.$item->id.'/delete') }}" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- JavaScript function to print/export table -->
    <script type="text/javascript">
        function printTable() {
            var printContents = document.getElementById('userTable').outerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>

</div>

@endsection