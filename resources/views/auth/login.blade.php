@extends('layout.base')
@section('title', 'Login')
@section('content')

<div class="container d-flex justify-content-center align-items-start mt-5" style="height: 80vh;">
    <div class="card p-4" style="width: 400px;">
        <div>
            @if(session()->has("success"))
                <div class="alert alert-success text-center">
                    {{ session()->get("success") }}  
                </div>
            @endif
            @if(session()->has("error"))
                <div class="alert alert-error">
                    {{ session()->get("error") }}  
                </div>
            @endif
            <form method="POST" action="{{ route("login.post") }}">
                @csrf
                <div class="mb-3">
                    <label for="Email" class="form-label">Email address</label>
                    <input type="email" name="email" class="form-control" id="Email" aria-describedby="emailHelp">
                    @if ($errors->has('email'))
                        <span class="text-danger">
                            {{ $errors->first('email') }}
                        </span>
                    @endif
                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
                <div class="mb-3">
                    <label for="Password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="Password">
                    @if ($errors->has('password'))
                        <span class="text-danger">
                            {{ $errors->first('password') }}
                        </span>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
                <div style="margin-top: 20px;">
                    <p>Don't have an account? <a href="{{ route("register") }}">Register here</a></p>
                </div> 
            </form>
        </div>
    </div>
</div>

@endsection