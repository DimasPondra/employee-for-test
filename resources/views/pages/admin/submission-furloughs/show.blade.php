@extends('layouts.admin')

@section('title', 'Show Submission Furlough')
@section('submissionFurloughPage', 'active')

@section('content')
    <div class="nav">
        <div class="d-flex justify-content-between align-items-center w-100 mb-3 mb-md-0">
            <div class="d-flex justify-content-start align-items-center">
                <button id="toggle-navbar" onclick="toggleNavbar()">
                    <img src="{{ asset('backend/images/icons/burger.svg') }}" class="mb-2" alt="icon">
                </button>
                <h2 class="nav-title">
                    <a href="{{ route('admin.submission-furlough.index') }}">Submission Furlough</a>
                </h2>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="row">
            <div class="col-12 d-flex justify-content-between">
                <h2 class="content-title mb-4">Detail Submission Furlough</h2>
                <div class="d-flex btn mb-2 mb-md-0 align-items-center">
                    <form action="{{ route('admin.submission-furlough.approve', $submissionFurlough) }}" method="POST">
                        @csrf

                        <button type="submit" class="btn btn-sm btn-primary">Approve Submission</button>
                    </form>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @error('errors')
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @enderror

            <div class="col-12">
                <div class="statistics-card">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="card-title">{{ $submissionFurlough->user->name }}</h5>
                        <span class="badge rounded-pill bg-secondary px-3 py-2">{{ $submissionFurlough->status }}</span>
                    </div>

                    <div class="row mb-3">
                        <div class="col-2">
                            <h6 class="card-subtitle">Occupation</h6>
                        </div>
                        <div class="col-10">
                            <h6 class="card-subtitle text-muted">: {{ $submissionFurlough->employee_occupation }}</h6>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-2">
                            <h6 class="card-subtitle">Furlough Type</h6>
                        </div>
                        <div class="col-10">
                            <h6 class="card-subtitle text-muted">: {{ $submissionFurlough->furlough_type }}</h6>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-2">
                            <h6 class="card-subtitle">Start Date</h6>
                        </div>
                        <div class="col-10">
                            <h6 class="card-subtitle text-muted">: {{ $submissionFurlough->format_start_date }}</h6>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-2">
                            <h6 class="card-subtitle">Last Date</h6>
                        </div>
                        <div class="col-10">
                            <h6 class="card-subtitle text-muted">: {{ $submissionFurlough->format_last_date }}</h6>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-2">
                            <h6 class="card-subtitle">Reason</h6>
                        </div>
                        <div class="col-10">
                            <h6 class="card-subtitle text-muted">: {{ $submissionFurlough->reason ?? '-' }}</h6>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-2">
                            <h6 class="card-subtitle">Submission Date</h6>
                        </div>
                        <div class="col-10">
                            <h6 class="card-subtitle text-muted">: {{ $submissionFurlough->format_submission_date }}</h6>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-2">
                            <h6 class="card-subtitle">Approve Date</h6>
                        </div>
                        <div class="col-10">
                            <h6 class="card-subtitle text-muted">: {{ $submissionFurlough->approve_date ? $submissionFurlough->format_approve_date : '-' }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
