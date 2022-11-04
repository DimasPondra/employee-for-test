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

                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex flex-column justify-content-around align-items-start employee-stat">
                            <h5 class="content-desc">Submission Furlough</h5>

                            <h3 class="statistics-value">{{ $submissionFurloughs }}</h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 mt-3">
                <h2 class="content-title">Chart for Submission Furlough</h2>
            </div>

            <form action="" method="GET" class="w-100">
                <div class="mb-4">
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <input type="text" name="name" value="{{ request('name') }}" class="form-control" placeholder="Search name employee">
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="form-group">
                                <input type="number" name="year" value="{{ request('year') }}" class="form-control" placeholder="Search year">
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="form-group">
                                <select class="form-select" name="furlough_type">
                                    <option selected value="">Select furlough type</option>
                                    @foreach ($furloughTypes as $furloughType)
                                        <option value="{{ $furloughType->name }}">{{ $furloughType->name }}</option>
                                    @endforeach
                                </select>
                                @error('furlough_type')
                                    <p class="text-danger text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-sm btn-success">Filter</button>
                    </div>
                </div>
            </form>

            <div class="col-12">
                <div class="statistics-card simple">
                    <div id="charts">
                        <canvas id="barchart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('after-script')
    <script src="{{ asset('backend/vendor/chart-js/chart.js') }}"></script>
    <script src="{{ asset('backend/vendor/chart-js/chartjs-plugin-labels.min.js') }}"></script>
    <script>
        let barLabels = ["Jan","Feb","Mar","Apr","Mei","Jun","Jul","Agu","Sep","Okt","Nov","Des"];
        let barData = {!! json_encode($dataBarChart) !!};

        // Line Chart
        let barchart = document.getElementById("barchart").getContext("2d");
        let renderBarchart = new Chart(barchart, {
            type: "bar",
            data: {
                labels: barLabels,
                datasets: [
                    {
                        label: "Total User",
                        data: barData,
                        borderColor: "#57C7D8",
                        borderWidth: 1,
                        backgroundColor: "#57C7D8",
                    },
                ],
            },
            options: {
                responsive: true,
                plugins: {
                    labels: {
                        render: () => {}
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        steps: 10,
                        max: 100
                    }
                }
            }
        });

    </script>
@endpush
