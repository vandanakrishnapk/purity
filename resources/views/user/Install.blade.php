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
      <h3 class="text-start mt-3 rounded-3">INSTALLATIONS</h3>
  </div>
          <div class="card-body">
              <table id="installTable" class="table table-striped dt-responsive nowrap w-100">
                  <thead class="bg-dark text-light">
                      <tr>
                        <th class="text-light">SlNo</th>
                          <th class="text-light">Client Name</th>
                          <th class="text-light">Mobile</th>
                          <th class="text-light">Product</th>
                          <th class="text-light">Requested On</th>
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

{{-- bid modal  --}}
<!-- Modal -->
<div class="modal fade" id="bidModal" tabindex="-1" aria-labelledby="bidModalLabel" aria-hidden="true">
    <div class="modal-dialog custom-modal modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-primary text-light">
          <h5 class="modal-title" id="bidModalLabel">Bid Details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body ps-4 pe-4 pb-4">
          <div id="bidDetails">
            <!-- Content will be loaded here via AJAX -->
          </div>
          <form id="submitInstall" method="POST">
            @csrf
            <div id="formErrors" class="alert alert-danger d-none"></div> <!-- Error container -->

            <br><br>
            <label for="rawWater">Raw Water TDS</label>
            <input type="text" name="rawWater" placeholder="Raw Water TDS" class="form-control mb-3">
            <span class="error rawWater_error text-danger"></span>

            <label for="sow">Source of Water</label>
            <br><br>
            <div class="custom-checkbox mb-3">
                <input type="checkbox" name="sow[]" class="custom-control-input" style="margin-left:60px" value="Bore Well"> Bore Well
                <input type="checkbox" name="sow[]" class="custom-control-input" style="margin-left:60px!important;" value="Open Well"> Open Well
                <input type="checkbox" name="sow[]" class="custom-control-input" style="margin-left:60px!important;" value="Pipe Line"> Pipe Line
                <input type="checkbox" name="sow[]" class="custom-control-input" style="margin-left:60px!important;" value="Pond"> Pond
                <input type="checkbox" name="sow[]" class="custom-control-input" style="margin-left:60px!important;" value="Others"> Others
                <span class="error sow_error text-danger"></span>
            </div>

            <br>
            <label for="nextService">Next Service</label>
            <select name="nextService" class="form-control">
                <option value="">Select Next Service</option>
                <option value="4 Months">4 Months</option>
                <option value="6 Months">6 Months</option>
                <option value="12 Months">12 Months</option>
            </select>
            <span class="error nextService_error text-danger"></span>

            <br>
            <input type="hidden" name="customer_id" id="customerId">
            <input type="hidden" name="staff_id" id="staffId">
       
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary submit-installation" style="margin-right:320px!important;">Submit</button>
        </form>
        </div>
      </div>
    </div>
  </div>
  
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
   <!-- Datatables js -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/date-fns/2.29.3/date-fns.min.js"></script>
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
    $('#installTable').DataTable({
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
                exportOptions: {
                    columns: [0, 1, 2, 3,4]
                }
            }
        ],
        lengthMenu: [
            [10, 25, 50, -1],
            ['10 Installations', '25 Installations', '50 Installations', 'All Installations']
        ],
        ajax: {
            url: `{{ url('/user/installation/view/data') }}`,
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
                        <button class="btn btn-success btn-sm bid-button" data-id="${row.individual_id}">
                           BID
                        </button>
                        
                    `;
                }
            }
        ]
    });
});
// more when bid 
$(document).ready(function() {
$('#installTable').on('click', '.bid-button', function() {
        var id = $(this).data('id');
        console.log(id)
        // Make an AJAX request to fetch the details
        $.ajax({
            url: `{{ url('/user/installation/view/bid') }}/${id}`,
            type: 'GET',
            success: function(response) {
                // Populate the modal with the received data
                console.log(response)
                $('#bidDetails').html(`
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
                $('#bidModal').modal('show');
            },
            error: function(xhr) {
                console.error('AJAX request failed:', xhr);
            }
        });
    });
    $(".submit-installation").click(function(e) {
        e.preventDefault();
        let form = $('#submitInstall')[0];
        let data = new FormData(form);

        $.ajax({
            url: `{{ url('/user/installation/new') }}`,
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
        $('#submitInstall')[0].reset(); // Clear form fields
        $('#bidModal').modal('hide'); // Optionally, close the modal
       
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

//submit application

    

</script>
@endpush