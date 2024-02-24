@extends('layouts.app')

@section('content')
<div class="container container-tight py-4">
    <div class="text-center mb-4">
        <a href="{{ url('/') }}" class="navbar-brand navbar-brand-autodark"><img src="{{ env('CDN')}}/img/logos/weil.png" height="36" alt="whateverilike"></a>
    </div>
    <form class="card card-md" action="{{ route('register') }}" method="POST" autocomplete="off" novalidate>
        @csrf
        <div class="card-body">
            <h2 class="card-title text-center mb-4">Create new account</h2>
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Enter name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Email address</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Enter email" value="{{ old('email') }}" required autocomplete="email">
                @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <div class="input-group input-group-flat">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" autocomplete="off" required>
                    <span class="input-group-text">
                        <a href="#" class="link-secondary" title="Show password" data-bs-toggle="tooltip"><!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg>
                        </a>
                    </span>
                </div>
                @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-check">
                    <input type="checkbox" class="form-check-input" required>
                    <span class="form-check-label">Agree the <a href="{{url('privacy-policy')}}" tabindex="-1">terms and policy</a>.</span>
                </label>
            </div>
            <div class="form-footer">
                <button type="submit" class="btn btn-primary w-100">Create new account</button>
            </div>
        </div>
    </form>
    <div class="text-center text-muted mt-3">
        Already have an account? <a href="{{ route('login') }}" tabindex="-1">Sign in</a>
    </div>
</div>
@endsection
