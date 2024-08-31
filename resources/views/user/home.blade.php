@extends('layout.user')
@section('data_table')

<div class="row">
  

    <div class="col-xl-4 h-75">
        <div class="card overflow-hidden border-top-0">
            <div class="progress progress-sm rounded-0 bg-light" role="progressbar" aria-valuenow="88" aria-valuemin="0" aria-valuemax="100">
                <div class="progress-bar bg-warning" style="width: 100%"></div>
            </div>
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="">
                        <p class="text-muted fw-semibold fs-16 mb-1">Installations</p>
                        <p class="text-muted mb-0">
                            <span class="badge bg-success-subtle text-success fs-3" id="inscounts">
                                <i class="bi bi-graph-up-arrow me-1"></i> 
                            </span>
                        
                        </p>
                    </div>
                    <div class="avatar-sm mb-4">
                        <div class="avatar-title bg-primary-subtle text-primary fs-24 rounded">
                        <a href=""><i class="ri-install-line">	</i></a>
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-wrap flex-lg-nowrap justify-content-center align-items-start mt-0">
            
                    <div class="d-flex justify-content-center align-items-start ">
                        <canvas id="installationsChart"></canvas>
                    </div>
                </div>
            </div><!-- end card-body -->
        </div><!-- end card -->
    </div><!-- end col -->

    <div class="col-xl-4 h-75">
        <div class="card overflow-hidden border-top-0">
            <div class="progress progress-sm rounded-0 bg-light" role="progressbar" aria-valuenow="88" aria-valuemin="0" aria-valuemax="100">
                <div class="progress-bar bg-danger" style="width: 100%"></div>
            </div>
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="">
                        <p class="text-muted fw-semibold fs-16 mb-1">Services</p>
                        <p class="text-muted mb-0">
                            <span class="badge bg-success-subtle text-success fs-3" id="servicecounts">
                                <i class="bi bi-graph-up-arrow me-1"></i> 
                            </span>
                        
                        </p>
                    </div>
                    <div class="avatar-sm mb-4">
                        <div class="avatar-title bg-primary-subtle text-primary fs-24 rounded">
                        <a href=""><i class="ri-tools-fill">	</i></a>
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-wrap flex-lg-nowrap justify-content-center align-items-start mt-0">
            
                    <div class="d-flex justify-content-center align-items-start ">
                        <canvas id="servicesChart"></canvas>
                    </div>
                </div>
            </div><!-- end card-body -->
        </div><!-- end card -->
    </div><!-- end col -->

@endsection 

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
 
$(document).ready(function() {
    $.ajax({
        url: `{{ url('/user/dashboard/installations/count') }}`, // Ensure this URL matches your route
        method: 'GET',
        success: function(data) {
            const totalCount = data.total;

            $('#inscounts').text(totalCount); // Use `.text()` to set text content

            const ctx = document.getElementById('installationsChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar', // Ensure vertical bars
                data: {
                    labels: ['Total Customers'],
                    datasets: [{
                        label: 'Installations',
                        data: [totalCount],
                        backgroundColor: '#def4b4', // Set background color
                        borderColor: '#def4b4', // Set border color
                        borderWidth: 1
                    }]
                },
                options: {
                    indexAxis: 'y', // Set this to display horizontal bars
                    responsive: true,
                    scales: {
                        x: {
                            beginAtZero: true,
                        },
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return value.toLocaleString();
                                }
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: true
                        },
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    return 'Total: ' + tooltipItem.raw;
                                }
                            }
                        }
                    }
                }
            });
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', status, error);
        }
    });
});

$(document).ready(function() {
    $.ajax({
        url: `{{ url('/user/dashboard/services/count') }}`, // Ensure this URL matches your route
        method: 'GET',
        success: function(data) {
            const totalCount = data.count;

            $('#servicecounts').text(totalCount); // Use `.text()` to set text content

            const ctx = document.getElementById('servicesChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar', // Ensure vertical bars
                data: {
                    labels: ['Total Customers'],
                    datasets: [{
                        label: 'Services',
                        data: [totalCount],
                        backgroundColor: '#FBF6E0', // Set background color
                        borderColor: '#FBF6E0', // Set border color
                        borderWidth: 1
                    }]
                },
                options: {
                    indexAxis: 'y', // Set this to display horizontal bars
                    responsive: true,
                    scales: {
                        x: {
                            beginAtZero: true,
                        },
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return value.toLocaleString();
                                }
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: true
                        },
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    return 'Total: ' + tooltipItem.raw;
                                }
                            }
                        }
                    }
                }
            });
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', status, error);
        }
    });
});
</script>
@endpush
