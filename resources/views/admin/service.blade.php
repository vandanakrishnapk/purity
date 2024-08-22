@extends('layout.index')

@section('css')
<link href="{{ asset('assets/vendor/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/vendor/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/vendor/datatables.net-fixedcolumns-bs5/css/fixedColumns.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/vendor/datatables.net-fixedheader-bs5/css/fixedHeader.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/vendor/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/vendor/datatables.net-select-bs5/css/select.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{ asset('assets/css/style.css')}}">
@endsection

@section('data_table')
<div class="card"> 
  <div class="card-header">
      <h3 class="text-start mt-3 rounded-3">SERVICES</h3>
  </div>
  <div class="card-body">
    <table id="serviceTable" class="table table-striped dt-responsive nowrap w-100">
      <thead class="bg-dark text-light">
        <tr>
          <th class="text-light">SlNo</th>
          <th class="text-light">Client Name</th>
          <th class="text-light">Mobile</th>
          <th class="text-light">Product</th>
          <th class="text-light">Installation Date</th>
          <th class="text-light">Last Service</th>
          <th class="text-light">Next Service</th>
          <th class="text-light">Action</th>
          
        </tr>                      
      </thead>
      <tbody>
        <!-- Data will be populated by DataTable -->
        <tr>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>

        </tr>
      </tbody>                      
    </table>
  </div>
</div>


<!-- Bootstrap Modal for displaying all services -->
<div class="modal fade" id="serviceDetailsModal" tabindex="-1" aria-labelledby="serviceDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h1 class="modal-title fs-5 text-light" id="serviceDetailsModalLabel">Service History</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4" id="serviceDetails">
                <!-- service details will be loaded here -->
            </div>
        </div>
    </div>
</div>

<!--feedback -->
<div class="modal fade" id="feedbackDetailsModal" tabindex="-1" aria-labelledby="feedbackDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h1 class="modal-title fs-5 text-light" id="feedbackDetailsModalLabel">Send Feedback</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4" id="feedbackDetails">
                <!-- feedback details will be loaded here -->
            </div>
        </div>
    </div>
</div>
@endsection


@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<!-- Datatables js -->
<script src="{{ asset('assets/vendor/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables.net-fixedcolumns-bs5/js/fixedColumns.bootstrap5.min.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables.net-select/js/dataTables.select.min.js') }}"></script>

<!-- Datatable Demo App js -->
<script src="{{ asset('assets/js/pages/datatable.init.js') }}"></script> 

<!-- Load parts to select -->
<script>$(document).ready(function() {
    $('#serviceTable').DataTable({
        processing: true,
        serverSide: true,
        destroy: true,
        searching: true,
        dom: "<'row'<'col-sm-6'B><'col-sm-6'f>>" +
             "<'row'<'col-sm-12'tr>>" +
             "<'row'<'col-sm-4'l><'col-sm-8'ip>>",
        buttons: [
            {
                extend: 'csvHtml5',
                text: 'Download CSV',
                titleAttr: 'Export to CSV',
                className: 'custombutton',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4]
                }
            }
        ],
        lengthMenu: [
            [10, 25, 50, -1],
            ['10 Installations', '25 Installations', '50 Installations', 'All Installations']
        ],
        ajax: {
            url: `{{ url('/admin/service/view/data') }}`,
            type: 'GET',
            dataSrc: 'data'
        },
        columns: [
            {
                name: 'serial_no',
                render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1; // Serial number
                }
            },
            { data: 'p_name', name: 'p_name' },
            { data: 'mobile', name: 'mobile' },
            { data: 'product_name', name: 'product_name' },
            {
                data: 'installation_date',
                name: 'installation_date',
                render: function(data, type, row) {
                    try {
                        const date = new Date(data);
                        const day = String(date.getDate()).padStart(2, '0');
                        const month = String(date.getMonth() + 1).padStart(2, '0');
                        const year = date.getFullYear();
                        const hours = date.getHours() % 12 || 12;
                        const minutes = String(date.getMinutes()).padStart(2, '0');
                        const ampm = date.getHours() >= 12 ? 'pm' : 'am';
                        return `${day}-${month}-${year} ${hours}:${minutes} ${ampm}`;
                    } catch (e) {
                        console.error('Date formatting error:', e);
                        return data; // Fallback to raw data if there's an error
                    }
                }
            },
            {
                data: 'created_at', name: 'created_at',
                render: function(data, type, row) {
                    try {
                        const date = new Date(data);
                        const day = String(date.getDate()).padStart(2, '0');
                        const month = String(date.getMonth() + 1).padStart(2, '0');
                        const year = date.getFullYear();
                        const hours = date.getHours() % 12 || 12;
                        const minutes = String(date.getMinutes()).padStart(2, '0');
                        const ampm = date.getHours() >= 12 ? 'pm' : 'am';
                        return `${day}-${month}-${year} ${hours}:${minutes} ${ampm}`;
                    } catch (e) {
                        console.error('Date formatting error:', e);
                        return data; // Fallback to raw data if there's an error
                    }
                }
            },
            {
              data:'nextService', name:'nextService',
              render: function(data, type, row) {
                    try {
                        const date = new Date(data);
                        const day = String(date.getDate()).padStart(2, '0');
                        const month = String(date.getMonth() + 1).padStart(2, '0');
                        const year = date.getFullYear();
                        return `${day}-${month}-${year}`;
                    } catch (e) {
                        console.error('Date formatting error:', e);
                        return data; // Fallback to raw data if there's an error
                    }
                  }
            },
            {
                // Adding the "View More" button column
                data: null,
                name: 'view_more',
                render: function(data, type, row) {
                    return `<button class="btn btn-primary ps-1 pe-1 pt-0 pb-0 view-more me-2" data-id="${row.serviceId}"><i class="ri-folder-history-line"></i>
                        </button>
                        <button class="btn btn-warning ps-1 pe-1 pt-0 pb-0 feedback" data-id="${row.serviceId}"><i class="ri-message-line"></i>
                        </button>                        
                        `;
                }
            }
        ]
    });

    // Event delegation to handle the "View More" button click
    $('#serviceTable').on('click', '.view-more', function() {
        var id = $(this).data('id');
        // Fetch and display more details based on the id
        $.ajax({
            url: `{{ url('/admin/service/view/details') }}/${id}`,
            type: 'GET',
            success: function(response) {
                let tableHtml = `
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th>Client Name</th>
                            <th>Mobile</th>
                            <th>Product</th>
                            <th>Installation Date</th>
                            <th>Last Service</th>
                            <th>Next Service</th>
                            </tr>
                        </thead>
                        <tbody>
                `;

                // Iterate over the response data and create table rows
                response.forEach(item => {
                    tableHtml += `
                        <tr>
                             <td>${item.p_name}</td>
                              <td>${item.mobile}</td>
                               <td>${item.product_name}</td>
                                <td>${item.installation_date}</td>
                                 <td>${item.created_at}</td>
                            <td>${item.nextService}</td>
                        </tr>
                    `;
                });

                // Close table HTML
                tableHtml += `
                        </tbody>
                    </table>
                `;
                $('#serviceDetails').html(tableHtml);
                $('#serviceDetailsModal').modal('show');
            },
            error: function(xhr, status, error) {
                console.error('Error fetching details:', error);
                // Optionally show an error message to the user
            }
        });
    });
});
//send feedback 
$(document).on('click', '.feedback', function() {
    const service_Id = $(this).data('id');
    
   $.get(`{{ url('/admin/service/feedback/view') }}/${service_Id}`, function(data) {
       
        const formHtml = `
           <form id="feedbackForm" action="" method="POST">
            @csrf
            <div class="form-group">
                <label for="feedback">Feedback:</label>
                <textarea id="feedback" name="feedback" class="form-control" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary mt-2 mx-5">Send</button>
        </form>
        `;
        
        // Inject the form HTML into the modal
        $('#feedbackDetails').html(formHtml);

        // Show the modal
        $('#feedbackDetailsModal').modal('show');
    });
}); 




</script>
@endpush
