@extends('layouts.admin')

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
                    <a href="{{ route('admin.submission-furlough.index') }}">Submission Furlough</a>
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
            </div>

            <form action="{{ route('admin.submission-furlough.export') }}" method="GET" class="w-100">
                <div class="mb-4">
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <select class="form-select" name="columns[]" multiple>
                                    <option disabled value="">Select Column</option>
                                    <option value="name">Name</option>
                                    <option value="start_date">Start Date</option>
                                    <option value="last_date">Last Date</option>
                                    <option value="furlough_type">Furlough Type</option>
                                    <option value="employee_occupation">Occupation</option>
                                    <option value="status">Status</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-sm btn-primary">Export Excel</button>
                    </div>
                </div>
            </form>

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
                                    <th>Username</th>
                                    <th>Furlough Type</th>
                                    <th>Occupation</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($submissionFurloughs as $submissionFurlough)
                                    <tr>
                                        <td>{{ $submissionFurlough->user->name }}</td>
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
                                                            href="{{ route('admin.submission-furlough.show', $submissionFurlough) }}"
                                                            class="btn btn-sm btn-link w-100 text-start"
                                                        >Show</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">No Data</td>
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
