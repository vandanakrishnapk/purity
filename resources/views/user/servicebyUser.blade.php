@extends('layout.user')

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
          <th class="text-light">Action</th>
        </tr>                      
      </thead>
      <tbody>
        <!-- Data will be populated by DataTable -->
      </tbody>                      
    </table>
  </div>
</div>
@endsection

@section('user_modal')    
<div class="modal fade fix-modal" id="fixModal" tabindex="-1" aria-labelledby="serviceDetailsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h1 class="modal-title fs-5 text-light" id="serviceDetailsModalLabel">Service Now</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4" id="serviceBody">
        <!-- Client details will be loaded here -->
        <div id="fixDetails">
            <!-- Content will be loaded here via AJAX -->
          </div>
        <form id="submitApplication" method="POST">
          @csrf                                        
          <div id="formErrors" class="alert alert-danger d-none"></div> <!-- Error container -->                                        
          <br><br>
          <label for="rawWater">Type Of Service</label><br>
          <div class="custom-radio mt-2">
            {{-- Paid, UW/Free, UW+Paid --}}
            <input type="radio" name="tos" class="form-check-input" value="Paid"><span class="ms-1 me-5">Paid</span>
            <input type="radio" name="tos" class="form-check-input" value="UW/Free"><span class="ms-1 me-5">UW/Free</span>
            <input type="radio" name="tos" class="form-check-input" value="UW+Paid"><span class="ms-1">UW+Paid</span>
          </div>                                       
          <span class="error tos_error text-danger"></span>
          <br><br>
          <label for="partsChanged">Parts Changed</label><br>
          <div class="card"></div>
          <select name="partsChanged[]" id="partsChange" class="form-control" multiple="multiple">
            <option value="">loading</option>
          </select>
          <span class="error partsChanged_error text-danger"></span>

          <label for="nextService">Select Next Service Duration:</label>
          <select id="duration" name="duration" class="form-control">
              <option value="">Select Option</option>
              <option value="4">4 Months</option>
              <option value="6">6 Months</option>
              <option value="12">12 Months</option>
          </select>
  
          <label for="specificDate">Or, select a specific date:</label>
          <input type="date" id="specificDate" name="specificDate" class="form-control">
          
      <!--date  will attach the below input -->
      <input type="hidden" id="nextService" name="nextService">
   
          <span class="error nextService_error text-danger"></span>

          <label for="">Amount Paid(if paid service)</label>
          <input type="text" name="amount" id="amount" class="form-control mt-3" >
          <span class="error amount_error text-danger"></span>

          <label for="">Remarks</label>
          <input type="text" name="remarks" id="remark" class="form-control mt-3">
          <span class="error remarks_error text-danger"></span>

          <input type="hidden" name="customer_id" id="customerId">
          <input type="hidden" name="staff_id" id="staffId">
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary submit-application" style="margin-right:320px!important;">Submit</button>
        </div>
    </form>
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


<!-- Include JS for Select2 -->
<!-- Datatable Demo App js -->


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
                title:'Service',
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
            url: `{{ url('/user/service/view/data') }}`,
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
                data: 'created_at',
                name: 'created_at',
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
                data: null,
                name: 'action',
                orderable: false,
                searchable: false,
                render: function(data, type, row) {
                    return `
                        <button class="btn btn-success btn-sm fix-button" data-id="${row.individual_id}">
                           Fix
                        </button>
                    `;
                }
            }
        ]
    });
});
//view more modal with service form
$(document).ready(function() {
$('#serviceTable').on('click', '.fix-button', function() {
   
        var id = $(this).data('id');
       
        // Make an AJAX request to fetch the details
        $.ajax({
            url: `{{ url('/user/service/view/fix') }}/${id}`,
            type: 'GET',
            success: function(response) {
               
                // Populate the modal with the received data
            
                $('#fixDetails').html(`
                <div class="mains p-3 border border-2 border-light">
                <div class="sec1 d-flex justify-content-between mt-2">
                <h4>Client Name: ${response.insDetails.p_name}</h4>
                <h4>Mobile: ${response.insDetails.mobile}</h4>
                </div>
                <div class="sec2 d-flex justify-content-between">
                <h4>Product: ${response.insDetails.product_name}</h4>
                <h4>Requested On: ${formatDate(response.insDetails.created_at)}</h4>
                 
                </div>
                </div>
                   
                    `);
                   
            document.getElementById('customerId').value = response.insDetails.individual_id;
            document.getElementById('staffId').value = response.staff_id;
            
        
                // Show the modal
                $('.fix-modal').modal('show');
            },
            error: function(xhr) {
                console.error('AJAX request failed:', xhr);
            }
        });
    });
   
});
//load parts changed on select
$(document).ready(function() {
 
      $.ajax({
                url: `{{ url('/user/service/parts/load') }}`, // Your endpoint URL
                type: 'GET',
                success: function(response) {
                    if (response.status === 1) {
                        var select = $('#partsChange');
                        select.empty(); // Clear existing options
                        select.append('<option value="">Select Parts Changed</option>'); // Add a default option

                        // Loop through the data and append options
                        $.each(response.data, function(index, item) {
                            select.append('<option value="' + item.parts_id + '">' + item.parts_name + '</option>');
                        }); 
                    

                      

                    } else {
                        alert(response.message);
                    }
                },
                error: function(xhr) {
                    alert('Failed to load data.');
                }
            }); 
        });
      
 $(document).ready(function() {
        $('#partsChange').select2({
            placeholder: 'Select an option',
            width: 'resolve'
        });
    });
// Helper function to format the date
function formatDate(dateStr) {
    const date = new Date(dateStr);
    const day = String(date.getDate()).padStart(2, '0');
    const month = String(date.getMonth() + 1).padStart(2, '0');
    const year = date.getFullYear();
    const hours = date.getHours() % 12 || 12;
    const minutes = String(date.getMinutes()).padStart(2, '0');
    const ampm = date.getHours() >= 12 ? 'pm' : 'am';
    return `${day}-${month}-${year} ${hours}:${minutes} ${ampm}`;
}
function updateNextService() {
            const durationValue = $('#duration').val();
            const dateValue = $('#specificDate').val();
            const today = new Date();
            const result = $('#result');
            let endDate;

            if (durationValue) {
                // Calculate the end date based on the selected duration
                endDate = new Date(today.setMonth(today.getMonth() + parseInt(durationValue, 10)));
                $('#nextService').val(`${endDate.toISOString().split('T')[0]}`);
          
            } else if (dateValue) {
                // Display the selected specific date
                $('#nextService').val(`${new Date(dateValue).toISOString().split('T')[0]}`);
             
            } else {
                // Clear the result and hidden input if neither option is selected
                $('#nextService').val('');
                result.text('');
            }
        }

        $('#duration').on('change', updateNextService);
        $('#specificDate').on('change', updateNextService);
        $(document).ready(function() {
    $(".submit-application").click(function(e) {
        e.preventDefault();
        let form = $('#submitApplication')[0];
        let data = new FormData(form);

        $.ajax({
            url: `{{ url('/user/service/new') }}`,
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
        $('#fixModal').modal('hide'); // Optionally, close the modal
        $('#serviceTable').DataTable().ajax.reload();
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

</script>
@endpush
