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
url: `{{ url('/user/dashboard/customer/count')}}`, // Ensure this URL is correct
method: 'GET',
success: function(data) {
const totalCount = data.total;

$('#cuscount').text(totalCount); // Use `.text()` to set text content

const ctx = document.getElementById('customerChart').getContext('2d');
new Chart(ctx, {
type: 'bar', // Ensure vertical bars
data: {
labels: ['Total Customers'],
datasets: [{
    label: 'Customer Count',
    data: [totalCount],
    backgroundColor: '#c8dbe9', // Set background color
    borderColor: '#c8dbe9', // Set border color
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
url: `{{ url('/user/dashboard/installations/count') }}`, // Ensure this URL matches your route
method: 'GET',
success: function(data) {
const labels = data.labels;
const counts = data.counts;
$('#inscounts').append(counts);
const ctx = document.getElementById('installationsChart').getContext('2d');
new Chart(ctx, {
type: 'line', // Line chart
data: {
labels: labels,
datasets: [{
    label: 'Installation Count',
    data: counts,
    backgroundColor: 'rgba(16, 48, 82, 0.2)', // Light color for fill
    borderColor: '#103052', // Line color
    borderWidth: 2,
    tension: 0.1 // Smoothing factor for the line
}]
},
options: {
responsive: true,
maintainAspectRatio: false,
scales: {
    x: {
        beginAtZero: true,
        title: {
            display: true,
            text: 'Month'
        }
    },
    y: {
        beginAtZero: true,
        title: {
            display: true,
            text: 'Count'
        },
        ticks: {
            callback: function(value) {
                return value.toLocaleString();
            }
        }
    }
},
plugins: {
    legend: {
        display: true,
        position: 'top'
    },
    tooltip: {
        callbacks: {
            label: function(tooltipItem) {
                return tooltipItem.dataset.label + ': ' + tooltipItem.raw;
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
const serviceCount = data.count;
$('#servicecounts').append(serviceCount);
const ctx = document.getElementById('servicesChart').getContext('2d');
new Chart(ctx, {
type: 'bar', // Column chart
data: {
labels: ['Total Services'],
datasets: [{
    label: 'Service Count',
    data: [serviceCount],
    backgroundColor: '#44943b', // Bar color
    borderColor: '#44943b', // Border color
    borderWidth: 1
}]
},
options: {
responsive: true,
maintainAspectRatio: false,
scales: {
    x: {
        beginAtZero: true,
        title: {
            display: true,
            text: 'Category' // Adjust as needed
        }
    },
    y: {
        beginAtZero: true,
        title: {
            display: true,
            text: 'Count' // Adjust as needed
        },
        ticks: {
            callback: function(value) {
                return value.toLocaleString(); // Format numbers with commas
            }
        }
    }
},
plugins: {
    legend: {
        display: true,
        position: 'top'
    },
    tooltip: {
        callbacks: {
            label: function(tooltipItem) {
                return tooltipItem.dataset.label + ': ' + tooltipItem.raw;
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
