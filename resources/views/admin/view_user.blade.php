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
        <h3 class="text-start mt-3 rounded-3">STAFF LIST</h3>
    </div>
            <div class="card-body">
                <table id="usersTable" class="table table-striped dt-responsive nowrap w-100">
                    <thead class="bg-dark text-light">
                        <tr>
                            <th class="text-light">S.No</th>
                            <th class="text-light">Name</th>
                            <th class="text-light">Email</th>
                            <th class="text-light">Mobile</th>
                            <th class="text-light">Designation</th>
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
@endsection
@section('user_modal')
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary add-user-btn" data-bs-toggle="modal" data-bs-target="#exampleModal" style="margin-left:138px">
<span class="plus-symbol">+</span>
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog custom-modal">
    <div class="modal-content">
      <div class="modal-header bg-primary text-light">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add User</h1>
        <button type="button" class="btn-close text-light" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
                                    <form id="submitApplication">
                                    @csrf 
                                    <div id="formErrors" class="alert alert-danger d-none"></div> <!-- Error container -->
                                    
                                    <br><label for="name">Name</label>
                                    <input type="text" name="name" id="name" placeholder="name" class="form-control">
                                    <span class="error name_error text-danger"></span>
                                    
                                    <br><label for="email">Email</label>
                                    <input type="email" name="email" id="email" placeholder="email" class="form-control">
                                    <span class="error email_error text-danger"></span>
                                    
                                    <br><label for="mobile">Mobile</label>
                                    <input type="text" name="mobile" id="mobile" placeholder="mobile" class="form-control">
                                    <span class="error mobile_error text-danger"></span>
                                    
                                    <br><label for="designation">Designation</label>
                                    <input type="text" name="designation" id="designation" placeholder="designation" class="form-control">
                                    <span class="error designation_error text-danger"></span>
                                    
                                    <br><label for="password">Password</label>
                                    <input type="password" name="password" id="password" placeholder="password" class="form-control">
                                    <span class="error password_error text-danger"></span>
                                </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary submit-application">Save changes</button>
      </div>
    </div>
  </div>
</div>


<!-- user details modal -->
<div class="modal fade" id="userDetailsModal" tabindex="-1" aria-labelledby="userDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h1 class="modal-title fs-5 text-light" id="userDetailsModalLabel">User Details</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4" id="userDetails">
                <!-- User details will be loaded here -->
            </div>
        </div>
    </div>
</div>

<!-- edit modal -->
<div class="modal fade" id="editDetailsModal" tabindex="-1" aria-labelledby="editDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h1 class="modal-title fs-5 text-light" id="editDetailsModalLabel">Edit User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4" id="editDetails">
                <!-- Form will be injected here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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

    <!-- Datatable Demo Aapp js -->
    <script src="{{ asset('assets/js/pages/datatable.init.js') }}"></script>
<script>

$(document).ready(function() {
    $('#usersTable').DataTable({
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
                    columns: [0,1,2,3,4] // Include the serial number column in export
                }
            }
        ],
        lengthMenu: [
            [10, 25, 50, -1],
            ['10 Users', '25 Users', '50 Users', 'All Users']
        ],
        
        ajax: {
            url: `{{ url('/admin/getUserData') }}`,
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
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'mobile', name: 'mobile' },
            { data: 'designation', name: 'designation' },
            {
                data: null,
                name: 'action',
                orderable: false,
                searchable: false,
                render: function(data, type, row, meta) {
                    return `
                        <button class="btn btn-secondary btn-sm more-user" data-id="${row.id}">
                            <i class="bi bi-three-dots"></i>
                        </button>
                        <button class="btn btn-warning btn-sm edit-user" data-id="${row.id}">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button class="btn btn-danger btn-sm delete-user" data-id="${row.id}">
                            <i class="bi bi-trash"></i>
                        </button>
                    `;
                }
            }
        ]
    });
});



//submit application
$(document).ready(function() {
    $(".submit-application").click(function(e) {
        e.preventDefault();
        let form = $('#submitApplication')[0];
        let data = new FormData(form);

        $.ajax({
            url: `{{ url('/admin/doAddUser') }}`,
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
        $('#exampleModal').modal('hide'); // Optionally, close the modal
        $('#usersTable').DataTable().ajax.reload();
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

//view,edit,delete 
$(document).on('click', '.more-user', function() {
    const userId = $(this).data('id');
    console.log('Clicked user ID:', userId);

    if (userId !== undefined) {
        $.get(`{{ url('/admin/users') }}/${userId}`, function(data) {
            console.log('Response data:', data);

            if (data && data.name && data.email && data.mobile && data.designation) {
                let userDetails = `
                    <p><strong>Name:</strong> ${data.name}</p>
                    <p><strong>Email:</strong> ${data.email}</p>
                    <p><strong>Mobile:</strong> ${data.mobile}</p>
                    <p><strong>Designation:</strong> ${data.designation}</p>
                `;
                $('#userDetails').html(userDetails);
                $('#userDetailsModal').modal('show');
            } else {
                $('#userDetails').html('<p>No user details available.</p>');
                $('#userDetailsModal').modal('show');
            }
        }).fail(function() {
            alert('Error retrieving user details.');
        });
    } else {
        console.error('User ID is undefined.');
    }
});
// edit user
$(document).on('click', '.edit-user', function() {
    const userId = $(this).data('id');
    
   $.get(`{{ url('/admin/users') }}/${userId}`, function(data) {
       
        const formHtml = `
            <form id="editUserForm" data-id="${data.id}">
            @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="${data.name}">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="${data.email}">
                </div>
                 <div class="mb-3">
                    <label for="mobile" class="form-label">Mobile</label>
                    <input type="text" class="form-control" id="mobile" name="mobile" value="${data.mobile}">
                </div>
                 <div class="mb-3">
                    <label for="designation" class="form-label">designation</label>
                    <input type="text" class="form-control" id="designation" name="designation" value="${data.designation}">
                </div>
        
                <button type="submit" class="btn btn-primary">Save changes</button>
            </form>
        `;
        
        // Inject the form HTML into the modal
        $('#editDetails').html(formHtml);

        // Show the modal
        $('#editDetailsModal').modal('show');
    });
}); 


//update user
$(document).on('submit', '#editUserForm', function(event) {
    event.preventDefault();    
    const userId = $(this).data('id');
    const formData = $(this).serialize();
    const url = `{{ url('/admin/users') }}/${userId}`; // Ensure this URL is correct

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
                $('#editUserForm')[0].reset();
                $('#editDetailsModal').modal('hide');
                $('#usersTable').DataTable().ajax.reload();
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


    
//delete user 
$(document).on('click', '.delete-user', function() {
    const userId = $(this).data('id');
    if(confirm('Are you sure you want to delete this user?')) {
        $.ajax({
            url: `{{ url('/admin/users') }}/${userId}`,
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
                $('#usersTable').DataTable().ajax.reload();
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

