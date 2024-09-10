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
          <th class="text-light">Date of Service</th>
          <th class="text-light">Next Service</th>
          <th class ="text-light">Assigned To</th>
          <th class ="text-light">Status</th>
          <th class ="text-light">Remarks</th>
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

<!--change staff modal -->
<div class="modal fade" id="changeStaffModal" tabindex="-1" aria-labelledby="changeStaffModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h1 class="modal-title fs-5 text-light" id="changeStaffModalLabel">Change Staff Here</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4" id="changeStaff">
                
            </div>
        </div>
    </div>
</div>

<!--change next service modal -->
<div class="modal fade" id="nextServiceModal" tabindex="-1" aria-labelledby="nextServiceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h1 class="modal-title fs-5 text-light" id="nextServiceModalLabel">Update Next Service Date</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4" id="nextServiceBody">
                
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
<script>
$(document).ready(function() {
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
                title: 'Requested Services',
                titleAttr: 'Export to CSV',
                className: 'custombutton',
                exportOptions: { 
                        columns: function (idx, data, node)
                         {               
                         return true;
                         } 
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
                data:'name',name:'name',
            }, 
            {
                data:'serviceStatus',name:'serviceStatus',
            },
            {
            data:'remarks',name:'remarks',
            },
            {
                // Adding the "View More" button column
                data: null,
                name: 'Action',
                render: function(data, type, row) {
                    return `<button class="btn btn-primary ps-1 pe-1 pt-0 pb-0 view-more me-2" data-id="${row.serviceId}"><i class="ri-folder-history-line"></i>
                        </button>  
                        <button class="btn btn-danger ps-1 pe-1 pt-0 pb-0 change-staff me-2" data-id="${row.serviceId}" data-user="${row.customer_id}"><i class=" ri-file-add-fill"></i>
                        </button>   
                         <button class="btn btn-info ps-1 pe-1 pt-0 pb-0 change-nextService me-2" data-id="${row.serviceId}"><i class="ri-calendar-2-line"></i>
                        </button>                  
                        `;
                }
            },
        ],
        columnDefs: [{ visible: false, targets: [4,5] }],

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
                 <div class="table-responsive"> <!-- Make table responsive -->
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th>Client Name</th>
                            <th>Mobile</th>
                            <th>Product</th>
                            <th>Installation Date</th>
                            <th>Date of Service</th>
                            <th>Next Service</th>
                            </tr>
                        </thead>
                        <tbody>
                `;

                // Iterate over the response data and create table rows
                response.history.forEach(item => {
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
                    </div>
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

$('#serviceTable').on('click', '.change-staff', function() {
    var id = $(this).data('id');
    var cust =$(this).data('user');

    // Fetch and display more details based on the id
    $.ajax({
        url: `{{ url('/admin/service/change/staff') }}/${id}`, // Adjust the URL as needed
        type: 'GET',
        success: function(response) {
            var users = response.users;
            var currentStaff = response.currentStaff;
            var serviceId = response.serviceId;
           

            // Create the form HTML
            var formHtml = `
                <form id="updateStaffForm" data-id="${serviceId}">
                @csrf
                    <div class="mb-3">
                        <label for="assigned_to" class="form-label">Change Staff</label>
                        <select id="assigned_to" name="assigned_to" class="form-control">
                            <option value="">Select a staff</option>
            `;

            // Populate the select options
            users.forEach(user => {
                formHtml += `<option value="${user.id}" ${user.id === currentStaff ? 'selected' : ''}>${user.name}</option>`;
            });

            formHtml += `
                        </select> 
                    </div>
                    <input type="hidden" name="customer_id" value="${cust}">
                    <div class="row">
                        <div class="col-4"></div>
                        <div class="col-4">
                              <button type="submit" class="btn btn-primary">Update</button>   
                        </div>
                    </div>
                </form>
            `;

            // Insert form HTML into the modal
            $('#changeStaff').html(formHtml);

            // Show the modal
            $('#changeStaffModal').modal('show');
        },
        error: function(xhr) {
            console.error('An error occurred:', xhr.responseText);
        }
    });
}); 
$(document).on('submit', '#updateStaffForm', function(event) {
    event.preventDefault();    
    const updateId = $(this).data('id');
    const formData = $(this).serialize();
    const url = `{{ url('/admin/service/update/staff') }}/${updateId}`; // Ensure this URL is correct

    $.ajax({
    url: url,
    type: 'POST',
    data: formData,
    dataType: "json",
    success: function(response) {
        if (response.status === 0) {
            $.each(response.error, function(key, value) {
                $('#' + key + '_error').text(value);
            });
            toastr.error('Please fix the errors and try again.', 'Validation Error', {
                positionClass: 'toast-top-right'
            });
        } else if (response.status === 1) {
            toastr.success(response.message, 'Success', {
                positionClass: 'toast-top-right'
            });
            $('#updateStaffForm')[0].reset();
            $('#changeStaffModal').modal('hide');
            $('#serviceTable').DataTable().ajax.reload();
        } else {
            toastr.error('Unexpected response format.', 'Error', {
                positionClass: 'toast-top-right'
            });
           
        }
    },
    error: function(xhr, status, error) {
        console.error(xhr.responseText);
        toastr.error('Something went wrong!', 'Error', {
            positionClass: 'toast-top-right'
        });
    }
});
});  

//update next service form

//nextServiceBody

$('#serviceTable').on('click', '.change-nextService', function() {
    var id = $(this).data('id');

    // Fetch and display more details based on the id
    $.ajax({
        url: `{{ url('/admin/service/change/nextService') }}/${id}`, // Adjust the URL as needed
        type: 'GET',
        success: function(response) {
          
            var currentNextService = response.currentnextService;
            var serviceId = response.serviceId;

            // Create the form HTML
            var formHtml = `
                <form id="updateNextServiceForm" data-id="${serviceId}">
                @csrf
                    <div class="mb-3">
                            <label for="specificDate">Select a specific date to update next Service:</label>
                            <input type="date" id="specificDate" name="nextService" class="form-control" value="${currentNextService}">
 
            `;         
            formHtml += `
                       
                    </div>
                    <div class="row">
                        <div class="col-4"></div>
                        <div class="col-4">
                              <button type="submit" class="btn btn-primary">Update</button>   
                        </div>
                    </div>
               
                </form>
            `;

            // Insert form HTML into the modal

            $('#nextServiceBody').html(formHtml);

            // Show the modal
            $('#nextServiceModal').modal('show');
        },
        error: function(xhr) {
            console.error('An error occurred:', xhr.responseText);
        }
    });
}); 

// update next service 

$(document).on('submit', '#updateNextServiceForm', function(event) {
    event.preventDefault();    
    const updateId = $(this).data('id');
    const formData = $(this).serialize();
   
    const url = `{{ url('/admin/service/update/nextService') }}/${updateId}`; // Ensure this URL is correct

    $.ajax({
    url: url,
    type: 'POST',
    data: formData,
    dataType: "json",
    success: function(response) {
        if (response.status === 0) {
            $.each(response.error, function(key, value) {
                $('#' + key + '_error').text(value);
            });
            toastr.error('Please fix the errors and try again.', 'Validation Error', {
                positionClass: 'toast-top-right'
            });
        } else if (response.status === 1) {
            toastr.success(response.message, 'Success', {
                positionClass: 'toast-top-right'
            });
            $('#updateNextServiceForm')[0].reset();
            $('#nextServiceModal').modal('hide');
            $('#serviceTable').DataTable().ajax.reload();
        } else {
            toastr.error('Unexpected response format.', 'Error', {
                positionClass: 'toast-top-right'
            });
           
        }
    },
    error: function(xhr, status, error) {
        console.error(xhr.responseText);
        toastr.error('Something went wrong!', 'Error', {
            positionClass: 'toast-top-right'
        });
    }
});
});  

</script>
@endpush

