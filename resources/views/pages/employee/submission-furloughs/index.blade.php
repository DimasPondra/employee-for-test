@extends('layouts.employee')

@section('title', 'Submission Furlough')
@section('submissionFurloughPage', 'active')

@section('content')
    <div class="nav">
        <div class="d-flex justify-content-between align-items-center w-100 mb-3 mb-md-0">
            <div class="d-flex justify-content-start align-items-center">
                <button id="toggle-navbar" onclick="toggleNavbar()">
                    <img src="{{ asset('backend/images/icons/burger.svg') }}" class="mb-2" alt="icon">
                </button>
                <h2 class="nav-title">
                    <a href="{{ route('employee.submission-furlough.index') }}">Submission Furlough</a>
                </h2>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center nav-input-container">
            <form action="" method="GET" class="w-100">
                <div class="nav-input-group">
                    <input type="text" name="name" value="{{ request('name') }}" class="nav-input" placeholder="Search name">
                    <button class="btn-nav-input"><img src="{{ asset('backend/images/icons/search.svg') }}" alt="icon"></button>
                </div>
            </form>
        </div>
    </div>

    <div class="content">
        <div class="row">
            <div class="col-12 d-flex justify-content-between">
                <h2 class="content-title mb-4">List Submission Furlough</h2>
                <div class="btn mb-2 mb-md-0">
                    <a href="{{ route('employee.submission-furlough.create') }}" class="btn btn-sm btn-primary">
                        Add new submission furlough
                    </a>
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
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Start Date</th>
                                    <th>Last Date</th>
                                    <th>Furlough Type</th>
                                    <th>Occupation</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($submissionFurloughs as $submissionFurlough)
                                    <tr>
                                        <td>{{ $submissionFurlough->format_start_date }}</td>
                                        <td>{{ $submissionFurlough->format_last_date }}</td>
                                        <td>{{ $submissionFurlough->furlough_type }}</td>
                                        <td>{{ $submissionFurlough->employee_occupation }}</td>
                                        <td>{{ $submissionFurlough->status }}</td>
                                        <td width="10%">
                                            <div class="dropdown">
                                                <button
                                                    class="btn btn-outline-primary dropdown-toggle"
                                                    type="button"
                                                    id="dropdownMenu"
                                                    data-bs-toggle="dropdown"
                                                    aria-expanded="false"
                                                ></button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu">
                                                    <li>
                                                        <a
                                                            href="{{ route('employee.submission-furlough.show', $submissionFurlough) }}"
                                                            class="btn btn-sm btn-link w-100 text-start"
                                                        >Show</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">No Data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="d-flex mt-4 justify-content-end">
                            {!! $submissionFurloughs->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
