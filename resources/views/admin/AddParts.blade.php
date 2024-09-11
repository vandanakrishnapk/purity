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
        <h3 class="text-start mt-3 rounded-3">PARTS</h3>
    </div>
            <div class="card-body">
                <table id="partsTable" class="table table-striped dt-responsive nowrap w-100">
                    <thead class="bg-dark text-light">
                        <tr>
                            <th class="text-light">S.No</th>
                            <th class="text-light">Name</th>
                            <th class="text-light">Action</th>                          
                        </tr>
                        
                    </thead>
                    <tbody>
                        <tr>
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
<button type="button" class="btn btn-primary add-user-btn" data-bs-toggle="modal" data-bs-target="#partsModal" style="margin-left:138px">
    <span class="plus-symbol">+</span>
    </button>
    
    <!-- Modal -->
    <div class="modal fade" id="partsModal" tabindex="-1" aria-labelledby="partsModalLabel" aria-hidden="true">
      <div class="modal-dialog custom-modal modal-lg">
        <div class="modal-content">
          <div class="modal-header bg-primary text-light">
            <h1 class="modal-title fs-5" id="partsModalLabel">Add Parts</h1>
            <button type="button" class="btn-close text-light" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body p-5">
                                        <form id="submitApplication" method="POST">
                                        @csrf 
                                        <div id="formErrors" class="alert alert-danger d-none"></div> <!-- Error container -->
                                        <h3 class="text-center text-primary p-1 rounded-1 w-50" style="margin-left:150px">Purity parts</h3>
                                        <br><label for="name">Parts Name</label>
                                        <input type="text" name="parts_name" id="parts_name" placeholder="parts Name" class="form-control">
                                        <span class="error parts_name_error text-danger"></span>
                                        
                                         </form>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary submit-application" style="margin-right:350px">Submit</button>
          </div>
        </div>
      </div>
    </div> 
{{-- edit parts modal --}} 
<div class="modal fade" id="editDetailsModal" tabindex="-1" aria-labelledby="editDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h1 class="modal-title fs-5 text-light" id="editDetailsModalLabel">Edit Parts</h1>
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


<!--Delete confirmation modal-->
<!-- Bootstrap Modal -->
<div id="deleteConfirmationModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header custommodal">
                <h5 class="modal-title text-light" id="deleteConfirmationModalLabel">Confirm Deletion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="modalMessage"></p>
            

                <table class="table table-bordered table-sm">
                
                    <tr>
                        <th>Parts Name</th>
                        <th><span id="modalUserName"></span></th>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary cancel" data-dismiss="modal">Cancel</button>
                <button type="button" id="confirmDelete" class="btn btn-danger">Delete</button>
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
//data table view 
$(document).ready(function() {
    $('#partsTable').DataTable({
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
                title: 'Parts',
                titleAttr: 'Export to CSV',
                className: 'custombutton',
                exportOptions: { 
                    columns: function (idx, data, node) {
                        return true;
                    } 
                }
            }
        ],
        lengthMenu: [
            [10, 25, 50, -1],
            ['10 Parts', '25 Parts', '50 Parts', 'All Parts']
        ],
        ajax: {
            url: `{{ url('/admin/service/getPartsData') }}`, // Ensure this URL matches your route
            type: 'GET',
            dataSrc: 'data'
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
            { data: 'parts_name', name: 'parts_name' },
            {
                data: null,
                name: 'action',
                orderable: false,
                searchable: false,
                render: function(data, type, row, meta) {
                    return `
                        <button class="btn btn-warning btn-sm edit-part" data-id="${row.parts_id}">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button class="btn btn-danger btn-sm delete-part" data-id="${row.parts_id}" data-parts="${row.parts_name}">
                            <i class="bi bi-trash"></i>
                        </button>
                    `;
                }
            }
        ]
    });
});





//parts submit
    $(document).ready(function() {
    $(".submit-application").click(function(e) {
        e.preventDefault();
        let form = $('#submitApplication')[0];
        let data = new FormData(form);

        $.ajax({
            url: `{{ url('/admin/service/parts/new') }}`,
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
        $('#partsModal').modal('hide'); // Optionally, close the modal
        $('#partsTable').DataTable().ajax.reload();
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

//edit parts 
$(document).on('click', '.edit-part', function() {
    const partId = $(this).data('id');
    
   $.get(`{{ url('/admin/service/parts/edit') }}/${partId}`, function(data) {
       
        const formHtml = `
            <form id="editpartForm" data-id="${data.parts_id}">
            @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="partsname" name="parts_name" value="${data.parts_name}">
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
//update parts 
$(document).on('submit', '#editpartForm', function(event) {
    event.preventDefault();    
    const partsId = $(this).data('id');
    const formData = $(this).serialize();
    const url = `{{ url('/admin/service/parts/update') }}/${partsId}`; // Ensure this URL is correct

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
                $('#editpartForm')[0].reset();
                $('#editDetailsModal').modal('hide');
                $('#partsTable').DataTable().ajax.reload();
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




//delete 


$(document).on('click', '.delete-part', function() {
    const Id = $(this).data('id');
    const partsName = $(this).data('parts'); // Assuming you have the username data attribute

  
    $('#modalUserName').text(partsName);
    $('#modalMessage').text('Are you sure you want to delete this Parts?');

    // Show the modal
    $('#deleteConfirmationModal').modal('show');
     $('.close').on('click', function()
    {
        $('#deleteConfirmationModal').modal('hide');
    });

    $('.cancel').on('click', function()
    {
        $('#deleteConfirmationModal').modal('hide');
    });  
    $('#confirmDelete').off('click').on('click', function() {
        $.ajax({
            url: `{{ url('/admin/service/parts/delete') }}/${Id}`,
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
                 $('#partsTable').DataTable().ajax.reload();
             
                $('#deleteConfirmationModal').modal('hide'); // Hide the modal on success
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                toastr.error('Something went wrong!', 'Error', {
                    positionClass: 'toast-top-right'
                });
            }
        });
    });
});



// $(document).on('click', '.delete-part', function() {
//     const partId = $(this).data('id');
//     if(confirm('Are you sure you want to delete this parts?')) {
//         $.ajax({
//             url: `{{ url('/admin/service/parts/delete') }}/${partId}`,
//             type: 'DELETE',
//             data: {
//                 _token: '{{ csrf_token() }}'
//             },
//             success: function(response) {
//                 if (response.status === 1) {
//                     toastr.success(response.message, 'Success', {
//                         positionClass: 'toast-top-right'
//                     });
//                 } else {
//                     toastr.error('Unexpected response format.', 'Error', {
//                         positionClass: 'toast-top-right'
//                     });
//                 }
//                 $('#partsTable').DataTable().ajax.reload();
//             },
//             error: function(xhr, status, error) {
//                 console.error(xhr.responseText);
//                 toastr.error('Something went wrong!', 'Error', {
//                     positionClass: 'toast-top-right'
//                 });
//             }
//         });
//     }
// });



</script>
@endpush