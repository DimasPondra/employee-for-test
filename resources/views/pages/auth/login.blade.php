@extends('layouts.app')

@section('title', 'Login')
@section('loginPage', 'active')

@section('content')
    <div class="container ps-3 p-md-4 mt-5">
        @error('auth')
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @enderror

        <div class="row d-flex justify-content-start">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('login-process') }}" method="POST">
                            @csrf

                            <div class="form-group mb-3">
                                <label for="email" class="mb-2">
                                    Email
                                    <span class="required">*</span>
                                </label>
                                <input
                                    type="email"
                                    class="form-control @error('email')
                                        is-invalid
                                    @enderror"
                                    id="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                >
                                @error('email')
                                    <p class="text-danger text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="password" class="mb-2">
                                    Password
                                    <span class="required">*</span>
                                </label>
                                <input
                                    type="password"
                                    class="form-control @error('password')
                                        is-invalid
                                    @enderror"
                                    id="password"
                                    name="password"
                                >
                                @error('password')
                                    <p class="text-danger text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
