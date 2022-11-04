@extends('layouts.admin')

@section('title', 'Dashboard')
@section('dashboardPage', 'active')

@section('content')
    <div class="nav">
        <div class="d-flex justify-content-between align-items-center w-100 mb-3 mb-md-0">
            <div class="d-flex justify-content-start align-items-center">
                <button id="toggle-navbar" onclick="toggleNavbar()">
                    <img src="{{ asset('backend/images/icons/burger.svg') }}" class="mb-2" alt="icon">
                </button>
                <h2 class="nav-title">Dashboard</h2>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="row">
            <div class="col-12">
                <h2 class="content-title">Dashboard</h2>
            </div>

            <div class="col-12 col-md-6 col-lg-4">
                <div class="statistics-card simple">

                    {{-- <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex flex-column justify-content-around align-items-start employee-stat">
                            <h5 class="content-desc">Products</h5>

                            <h3 class="statistics-value">{{ $products }}</h3>
                        </div>
                    </div> --}}
                </div>
            </div>

        </div>
    </div>
@endsection
