@extends('layout.index') 
@section('css')

    <link href="{{ asset('assets/vendor/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendor/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendor/datatables.net-fixedcolumns-bs5/css/fixedColumns.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendor/datatables.net-fixedheader-bs5/css/fixedHeader.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendor/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendor/datatables.net-select-bs5/css/select.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />

@endsection 
@section('data_table')
<div class="card"> 
    <div class="card-header">
        <h3 class="text-start mt-3 rounded-3">Service Due</h3>
    </div>
            <div class="card-body">
                <table id="serviceDueTable" class="table table-striped dt-responsive nowrap w-100">
                    <thead class="bg-dark text-light">
                        <tr>
                            <th class="text-light">S.No</th>
                            <th class="text-light">Client Name</th>
                            <th class="text-light">Product Name</th>
                            <th class="text-light">Installation Date</th>
                            <th class="text-light">Main Service</th>
                            <th class="text-light">Days Left</th>
                            <th class="text-light">Assigned To</th>
                            <th class="text-light">Action</th>
                        </tr>
                        
                    </thead>
                    <tbody>
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
                <h1 class="modal-title fs-5 text-light" id="nextServiceModalLabel">Update Main Service Date</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4" id="nextServiceBody">
                
            </div>
        </div>
    </div>
</div>
@endsection


@push('scripts')



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

    <!-- Datatable Demo Aapp js -->
    <script src="{{ asset('assets/js/pages/datatable.init.js') }}"></script>
<script>
     $(document).ready(function() {
        $('#serviceDueTable').DataTable({
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
                    title: 'Service Due',
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
                ['10 Due', '25 Due', '50 Due', 'All Due']
            ],
            ajax: {
                url: `{{ url('/admin/service/due/table') }}`,
                type: 'GET',
                dataSrc: 'data',
            },
            columns: [
                {
                    data: null,
                    orderable: false,
                    searchable: false,
                    className: 'text-center',
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1; // Serial number
                    }
                },
                { data: 'client_name', name: 'client_name' },
                { data: 'product_name', name: 'product_name' },
                { data: 'installation_date', name: 'installation_date' },
                { data: 'reminder_date', name: 'reminder_date' },
                { data: 'days_left', name: 'days_left',
                render: function(data, type, row) {
            // Determine badge class based on days left
                 let badgeClass = data < 15 ? 'text-bg-warning' : 'text-bg-primary';

            // Return the formatted badge
                 return `<span class="badge ${badgeClass}">${data} days</span>`;
                 }
                }, 
                {
                    data:'staff' ,name:'staff',
                },
                {
                // Adding the "View More" button column
                data: null,
                name: 'Action',
                render: function(data, type, row) {
                    console.log('Row Data:', row); // Debugging line to see the row data
                    if (row) {
                        return ` 
                            <button class="btn btn-danger ps-1 pe-1 pt-0 pb-0 change-staff me-2" 
                                data-id="${row.installId}" 
                                data-user="${row.customer_id}">
                                <i class="ri-file-add-fill"></i>
                            </button> 
                            <button class="btn btn-info ps-1 pe-1 pt-0 pb-0 change-nextService me-2" 
                                data-id="${row.installId}">
                                <i class="ri-calendar-2-line"></i>
                            </button>   
                        `;
                    }
                }
            }
            ]
        });
    });



    $('#serviceDueTable').on('click', '.change-staff', function() {
    var id = $(this).data('id');  
 
    var user = $(this).data('user');
       // Fetch and display more details based on the id
    $.ajax({
        url: `{{ url('/admin/servicedue/change/staff') }}/${id}`, // Adjust the URL as needed
        type: 'GET',
        success: function(response) {
            var users = response.users;
            var currentStaff = response.currentStaff;
            var installId = response.installId;
           

            // Create the form HTML
            var formHtml = `
                <form id="updateStaffForm" data-id="${installId}">
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
                    <input type="hidden" name="customer_id" value="${user}">
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

//update staff 
$(document).on('submit', '#updateStaffForm', function(event) {
    event.preventDefault();    
    const updateId = $(this).data('id');
    const formData = $(this).serialize();
    const url = `{{ url('/admin/servicedue/update/staff') }}/${updateId}`; // Ensure this URL is correct

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
            $('#serviceDueTable').DataTable().ajax.reload();
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

//next service form 

$('#serviceDueTable').on('click', '.change-nextService', function() {
    var id = $(this).data('id');

    // Fetch and display more details based on the id
    $.ajax({
        url: `{{ url('/admin/servicedue/change/nextService') }}/${id}`, // Adjust the URL as needed
        type: 'GET',
        success: function(response) {
          
            var currentNextService = response.currentMainService;
            var installId = response.installId;

            // Create the form HTML
            var formHtml = `
                <form id="updateNextServiceForm" data-id="${installId}">
                @csrf
                    <div class="mb-3">
                            <label for="specificDate">Select a specific date to update next Service:</label>
                            <input type="date" id="specificDate" name="mainService" class="form-control" value="${currentNextService}">
 
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


// update Main service 


$(document).on('submit', '#updateNextServiceForm', function(event) {
    event.preventDefault();    
    const updateId = $(this).data('id');
    const formData = $(this).serialize();
   
    const url = `{{ url('/admin/servicedue/update/mainService') }}/${updateId}`; // Ensure this URL is correct

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


