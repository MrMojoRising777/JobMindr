@extends('layouts.app')

@section('header')
    <h2 class="fw-semibold fs-4 text-dark">
        {{ __('Dashboard') }}
    </h2>
@endsection

@section('content')
    <div class="card shadow-sm rounded">
        <div class="card-body text-dark">
            <div class="row">
                <div class="col-4">
                    <h3 class="card-title">Weekly Report</span>

                    <div class="row mt-3">
                        <div class="col-6">
                            <div class="card shadow-sm rounded">
                                <div class="card-body text-dark text-center">
                                    <h5 class="card-title text-warning">Applied</h5>

                                    <span class="text-warning fs-5 fw-semibold">{{ $applications->count() }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="card shadow-sm rounded bg-warning-emphasis">
                                <div class="card-body text-dark text-center">
                                    <h5 class="card-title text-danger">Rejected</h5>

                                    <span class="text-danger fs-5 fw-semibold">{{ $rejectedApplications->count() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-8">
                    <div class="d-flex mb-3 justify-content-end">
                        <button id="showWeek" class="btn btn-outline-primary me-2">Week</button>
                        <button id="showMonth" class="btn btn-outline-secondary">Month</button>
                    </div>

                    <canvas id="applicationsChart" width="100%" height="40"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let chart;
        let weeklyData = [], monthlyData = [];

        function renderChart(data) {
            const ctx = document.getElementById('applicationsChart').getContext('2d');
            const labels = data.map(d => d.date);
            const counts = data.map(d => d.count);

            if (chart) {
                chart.destroy();
            }

            chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Applications per Day',
                        data: counts,
                        borderColor: 'rgb(75, 192, 192)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        tension: 0.3,
                        fill: true,
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        $(document).ready(function () {
            $.get("{{ route('applications.stats') }}", function (data) {
                weeklyData = data.weekly;
                monthlyData = data.monthly;

                renderChart(weeklyData);
            });

            $('#showWeek').on('click', function () {
                renderChart(weeklyData);
                $('#showWeek').addClass('btn-primary').removeClass('btn-outline-primary');
                $('#showMonth').addClass('btn-outline-secondary').removeClass('btn-secondary');
            });

            $('#showMonth').on('click', function () {
                renderChart(monthlyData);
                $('#showMonth').addClass('btn-secondary').removeClass('btn-outline-secondary');
                $('#showWeek').addClass('btn-outline-primary').removeClass('btn-primary');
            });
        });
    </script>
@endpush
