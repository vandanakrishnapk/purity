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
        <h3 class="text-start mt-3 rounded-3">CORPORATE PURCHASES</h3>
    </div>
            <div class="card-body">
                <table id="corporateTable" class="table table-striped dt-responsive nowrap w-100">
                    <thead class="bg-dark text-light">
                        <tr>
                            <th class="text-light">S.No</th>
                            <th class="text-light">Company Name</th>
                            <th class="text-light">Center Name</th>
                            <th class="text-light">Sub Center</th>
                            <th class="text-light">Contact Person</th>
                            <th class="text-light">Contact Mobile</th>
                            <th class="text-light">Contact Address</th>
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
                            <td></td>
                        </tr>
                    </tbody>                      
                </table>
            </div>
        </div>
@endsection
@section('user_modal')

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary add-user-btn" data-bs-toggle="modal" data-bs-target="#corporateModal" style="margin-left:138px">
    <span class="plus-symbol">+</span>
    </button>
    
    <!-- Modal -->
    <div class="modal fade" id="corporateModal" tabindex="-1" aria-labelledby="corporateModalLabel" aria-hidden="true">
      <div class="modal-dialog custom-modal modal-lg">
        <div class="modal-content">
          <div class="modal-header bg-primary text-light">
            <h1 class="modal-title fs-5" id="corporateModalLabel">Add Company Purchase</h1>
            <button type="button" class="btn-close text-light" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body p-5">
    



                                        <form id="submitApplication" method="POST">
                                        @csrf 
                                        <div id="formErrors" class="alert alert-danger d-none"></div> <!-- Error container -->
                                        <h3 class="text-center text-primary p-1 rounded-1 w-50" style="margin-left:150px">Corporate Company</h3>
                                        <br><label for="name">Company Name</label>
                                        <input type="text" name="company_name" id="company_name" placeholder="Company Name" class="form-control">
                                        <span class="error company_name_error text-danger"></span>
                                        
                                        <br><label for="center_name">Center Name</label>
                                        <input type="email" name="center_name" id="center_name" placeholder="Center Name" class="form-control">
                                        <span class="error center_name_error text-danger"></span>
                                        
                                        <br><label for="sub_center">Sub Center</label>
                                        <input type="text" name="sub_center" id="sub_center" placeholder="Sub Center" class="form-control">
                                        <span class="error sub_center_error text-danger"></span>
                                      
                                        <br>
                                        <h3 class="text-center text-primary p-1 rounded-1 w-50" style="margin-left:150px">Contact Person</h3>
                                        <label for="contact_person">Name</label>
                                        <input type="text" name="contact_person" id="contact_person" placeholder="Name" class="form-control">
                                        <span class="error contact_person_error text-danger"></span>
                                        
                                        <br><label for="contact_mobile">Mobile</label>
                                        <input type="text" name="contact_mobile" id="contact_mobile" placeholder="Mobile" class="form-control">
                                        <span class="error contact_mobile_error text-danger"></span>

                                        <br><label for="center_address">Center Address</label>
                                        <textarea name="center_address" id="center_address" cols="30" rows="5" placeholder="Center Address" class="form-control"></textarea>
                                        <span class="error center_address_error text-danger"></span>
                                    </form>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary submit-application" style="margin-right:350px">Submit</button>
          </div>
        </div>
      </div>
    </div>
    
   <!-- company view more modal -->
<div class="modal fade" id="corporateDetailsModal" tabindex="-1" aria-labelledby="corporateDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h1 class="modal-title fs-5 text-light" id="corporateDetailsModalLabel">Company Details</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4" id="corporateDetails">
                <!-- Company details will be loaded here -->
            </div>
        </div>
    </div>
</div>  
<!--edit company modal -->
<div class="modal fade" id="editDetailsModal" tabindex="-1" aria-labelledby="editDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg p-2">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h1 class="modal-title fs-5 text-light" id="editDetailsModalLabel">Edit Company Purchase</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4" id="editDetails">
                <!-- Form will be injected here -->
            </div>
            
        </div>
    </div>
</div>

@endsection 

@push('scripts')

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="{{ asset('assets/js/pages/datatable.init.js') }}"></script>
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

<script>
    //data table view 
    $(document).ready(function() {
    $('#corporateTable').DataTable({
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
                text: 'Download Excel',
                titleAttr: 'Export to CSV',
                className: 'custombutton',
                exportOptions:{
                    columns: [0,1,2,3,4,5,6] // Update columns to include the new serial number column
                }
            }
        ],
        lengthMenu: [
            [10, 25, 50, -1],
            ['10 Purchases', '25 Purchases', '50 Purchases', 'All Purchases']
        ],
        
        ajax: {
            url: `{{ url('/admin/purchase/corporate/view') }}`,
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
            { data: 'company_name', name: 'company_name' },
            { data: 'center_name', name: 'center_name' },
            { data: 'sub_center', name: 'sub_center' },
            { data: 'contact_person', name: 'contact_person' },
            { data: 'contact_mobile', name: 'contact_mobile' },
            { data: 'center_address', name: 'center_address' },
            {
                data: null,
                name: 'action',
                orderable: false,
                searchable: false,
                render: function(data, type, row, meta) {
                    return `
                        <button class="btn btn-secondary btn-sm view-company" data-id="${row.corporate_id}">
                            <i class="bi bi-three-dots"></i>
                        </button>
                        <button class="btn btn-warning btn-sm edit-company" data-id="${row.corporate_id}">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button class="btn btn-danger btn-sm delete-company" data-id="${row.corporate_id}">
                            <i class="bi bi-trash"></i>
                        </button>
                    `;
                }
            }
        ],
        columnDefs: [{ visible: false, targets: [3, 5] }],
    });
});


//submit corporate company
    $(document).ready(function() {
    $(".submit-application").click(function(e) {
        e.preventDefault();
        let form = $('#submitApplication')[0];
        let data = new FormData(form);

        $.ajax({
            url: `{{ url('/admin/purchase/corporate/new') }}`,
            type: "POST",
            data: data,
            dataType: "JSON",
            processData: false,
            contentType: false,
            success: function(response) {
            console.log(response); // Log response for debugging

    // Clear previous error messages
    $('.error').text('');

    if (response.status === 0) {
        $.each(response.error, function(key, value) {
            $('#' + key).next('.error').text(value);
        });
        toastr.error('Please fix the errors and try again.', 'Validation Error', { positionClass: 'toast-top-right' });
    } else if (response.status === 1) {
        toastr.success(response.message, 'Success', { positionClass: 'toast-top-right' });
        $('#submitApplication')[0].reset(); // Clear form fields
        $('#corporateModal').modal('hide'); // Optionally, close the modal
        $('#corporateTable').DataTable().ajax.reload();
    } else {
        toastr.error('Unexpected response format', 'Error', { positionClass: 'toast-top-right' });
       
    }
},
error: function(xhr, status, error) {
    console.error(xhr.responseText);
    toastr.error('Something went wrong!', 'Error', { positionClass: 'toast-top-right' });
}

    });
});
    });  

//view more 
$(document).on('click', '.view-company', function() {
    const companyId = $(this).data('id');
    console.log('Clicked company ID:', companyId);

    if (companyId !== undefined) {
        $.get(`{{ url('/admin/purchase/company') }}/${companyId}`, function(data) {
            console.log('Response data:', data);

            if (data && data.company_name && data.center_name && data.sub_center && data.contact_person && data.contact_mobile && data.center_address) {
                let corporateDetails = `
                    <p><strong>Company Name:</strong> ${data.company_name}</p>
                    <p><strong>Center Name:</strong> ${data.center_name}</p>
                    <p><strong>Sub center:</strong> ${data.sub_center}</p>
                    <p><strong>Contact Person:</strong> ${data.contact_person}</p>
                    <p><strong>Contact Mobile:</strong> ${data.contact_mobile}</p>
                    <p><strong>Center Address:</strong> ${data.center_address}</p>
                `;
                $('#corporateDetails').html(corporateDetails);
                $('#corporateDetailsModal').modal('show');
            } else {
                $('#corporateDetails').html('<p>No company details available.</p>');
                $('#corporateDetailsModal').modal('show');
            }
        }).fail(function() {
            alert('Error retrieving company details.');
        });
    } else {
        console.error('Company ID is undefined.');
    }
});
//edit corporate companies  

$(document).on('click', '.edit-company', function() {
    const userId = $(this).data('id');
    
   $.get(`{{ url('/admin/purchase/company') }}/${userId}`, function(data) {
       
        const formHtml = `
            <form id="editCompanyForm" data-id="${data.corporate_id}">
            @csrf
                <div class="mb-3">
                    <label for="company_name" class="form-label">Company Name</label>
                    <input type="text" class="form-control" id="edit_company_name" name="company_name" value="${data.company_name}">
                </div>
                <div class="mb-3">
                    <label for="Center Name" class="form-label">Center Name</label>
                    <input type="text" class="form-control" id="edit_center_name" name="center_name" value="${data.center_name}">
                </div>
                 <div class="mb-3">
                    <label for="sub_center" class="form-label">Sub Center</label>
                    <input type="text" class="form-control" id="edit_sub_center" name="sub_center" value="${data.sub_center}">
                </div>
                 <div class="mb-3">
                    <label for="contact_person" class="form-label">Contact Person</label>
                    <input type="text" class="form-control" id="edit_contact_person" name="contact_person" value="${data.contact_person}">
                </div>
                 <div class="mb-3">
                    <label for="contact_mobile" class="form-label">Contact Mobile</label>
                    <input type="text" class="form-control" id="edit_contact_mobile" name="contact_mobile" value="${data.contact_mobile}">
                </div>
                 <div class="mb-3">
                    <label for="center_address" class="form-label">Center Address</label>
                    <input type="text" class="form-control" id="edit_center_address" name="center_address" value="${data.center_address}">
                </div>
        
                <button type="submit" class="btn btn-primary" style="margin-left:260px;">Save changes</button>
            </form>
        `;
        
        // Inject the form HTML into the modal
        $('#editDetails').html(formHtml);

        // Show the modal
        $('#editDetailsModal').modal('show');
    });
}); 
// update company purchase 

$(document).on('submit', '#editCompanyForm', function(event) {
    event.preventDefault();    
    const updateId = $(this).data('id');
    const formData = $(this).serialize();
    const url = `{{ url('/admin/purchase/company') }}/${updateId}`; // Ensure this URL is correct

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
                $('#editCompanyForm')[0].reset();
                $('#editDetailsModal').modal('hide');
                $('#corporateTable').DataTable().ajax.reload();
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

//delete company 

$(document).on('click', '.delete-company', function() {
    const purchaseId = $(this).data('id');
    if(confirm('Are you sure you want to delete this purchase?')) {
        $.ajax({
            url: `{{ url('/admin/purchase/company/') }}/${purchaseId}`,
            type: 'DELETE',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.status === 1) {
                    toastr.success(response.message, 'Success', {
                        positionClass: 'toast-top-right'
                    });
                } else {
                    toastr.error('Unexpected response format.', 'Error', {
                        positionClass: 'toast-top-right'
                    });
                }
                $('#corporateTable').DataTable().ajax.reload();
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                toastr.error('Something went wrong!', 'Error', {
                    positionClass: 'toast-top-right'
                });
            }
        });
    }
});

</script>
@endpush 