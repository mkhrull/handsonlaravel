@extends('layout.base')
@section('title', 'Register')
@section('content')

<div class="container d-flex justify-content-center align-items-start mt-5" style="height: 80vh;">
    <div class="card p-4" style="width: 400px;">
        <div>
            @if(session()->has("success"))
                <div class="alert alert-success text-center">
                    {{ session()->get("success") }}  
                </div>
            @endif
            @if(session()->has("error") && $errors->has('email'))
                <div class="alert alert-error">
                    {{ session()->get("error") }}  
                </div>
            @endif
            <form method="POST" action="{{ route("register.post") }}">
                @csrf
                <div class="mb-3">
                    <label for="fullName" class="form-label">Full Name</label>
                    <input type="text" name="name" class="form-control" id="fullName">
                    @if ($errors->has('name'))
                        <span class="text-danger">
                            {{ $errors->first('name') }}
                        </span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
                    @if ($errors->has('email'))
                        <span class="text-danger">
                            {{ $errors->first('email') }}
                        </span>
                    @endif
                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    @if(session('error') && !$errors->has('email'))
                        <div style="color: red;">{{ session('error') }}</div>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="phonenum" class="form-label">Phone Number</label>
                    <input type="text" name="phonenum" class="form-control" id="phonenum">
                    @if ($errors->has('phonenum'))
                        <span class="text-danger">
                            {{ $errors->first('phonenum') }}
                        </span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password">
                    @if ($errors->has('password'))
                        <span class="text-danger">
                            {{ $errors->first('password') }}
                        </span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="confirm-password" class="form-label">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" id="confirm-password">
                    <span id="password-match-message"></span>
                </div>
                <button type="submit" class="btn btn-primary">Register</button>
            </form>
            <div style="margin-top: 20px;">
                <p>Already have an account? <a href="{{ route("login") }}">Login here</a></p>
            </div>
        </div>
    </div>
</div>

<script>
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('confirm-password');
    const passwordMatchMessage = document.getElementById('password-match-message');

    confirmPasswordInput.addEventListener('input', function() {
        if (passwordInput.value === confirmPasswordInput.value) {
            passwordMatchMessage.textContent = 'Passwords match';
            passwordMatchMessage.style.color = 'green';
        } else {
            passwordMatchMessage.textContent = 'Passwords do not match';
            passwordMatchMessage.style.color = 'red';
        }
    });
</script>

@endsection