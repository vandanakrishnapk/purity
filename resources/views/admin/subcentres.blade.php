@extends('layout.index')
@section('css')
<!-- Vendor DataTables CSS -->
<link href="{{ asset('assets/vendor/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/vendor/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/vendor/datatables.net-fixedcolumns-bs5/css/fixedColumns.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/vendor/datatables.net-fixedheader-bs5/css/fixedHeader.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/vendor/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/vendor/datatables.net-select-bs5/css/select.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />

<!-- App CSS -->
<link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />

<!-- Icons CSS -->
<link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
@endsection 


@section('user_modal')
<button type="button" class="btn btn-primary float-end add-user-btn" data-bs-toggle="modal" data-bs-target="#CompanysubcentreDetailsModal">
<span class="plus-symbol">+</span>
</button>

<div class="modal fade" id="CompanysubcentreDetailsModal" class="subcentreDetail" tabindex="-1" aria-labelledby="CompanysubcentreDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h1 class="modal-title fs-5 text-light" id="CompanysubcentreDetailsModalLabel">Add Sub Centre</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4" id="CompanysubcentreDetails">
            <form id="AddsubcentreForm" method="POST">
              @csrf
            <div class="row align-items-start justify-content-start">
                <div class="col-11">
                <label>Company</label>
                <select id="company-select" name="company_id" class="form-select">
                @foreach($company as $com)
                <option value="{{ $com->company_id }}">{{ $com->company_name }}</option>
                @endforeach
              </select><br>
                </div>
                <div class="col-1 text-start mt-3">
                <button type="button" class="btn btn-primary add-user-btn mt-2" data-bs-toggle="modal" data-bs-target="#CompanyDetailsModal">
                <span class="plus-symbol">+</span>
            </button>
                </div>
            </div>
           
            
    <div class="row align-items-start justify-content-start">
        <div class="col-11">
            <label for="centre-select">Centre</label>
            <select id="centre-select" name="centre_id" class="form-select">
                <option value=""></option>
            </select>
        </div>
        <div class="col-1 text-start mt-3">
            <button type="button" class="btn btn-primary add-user-btn mt-2" data-bs-toggle="modal" data-bs-target="#centreDetailsModal">
                <span class="plus-symbol">+</span>
            </button>
            
        </div>
    </div>
<div class="row align-items-start justify-content-start">
    <div class="col-11">
    <label>Subcentre</label>
            <input type="text" name="subcentre_name" class="form-control" >
    </div>
    <div class="col-1 text-start mt-3">
    
    </div>
</div>
    <div class="row align-items-start justify-content-start">
        <div class="col-12">
        <label>Remarks:</label>
                <input type="text" name="remarks" class="form-control" >
        </div>
       
</div>   
<div class="row">
    <div class="col-5">  </div>
        <div class="col-2">
            <button type="submit" class="btn btn-primary mt-2 w-100" >Submit</button>
        </div>    
      
</div>
 
    
            </form>
            </div>
        </div>
    </div>
</div> 
<div class="modal fade" id="centreDetailsModal" tabindex="-1" aria-labelledby="centreDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h1 class="modal-title fs-5 text-light" id="centreDetailsModalLabel">Add centre</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4" id="centreDetails">
            <form id="centreForm" method="POST">
            @csrf
        
        <label for="centre">Company:</label>
        <select id="Company1" name="company_id" class="form-control">      
        </select><br>
        
        <label for="centre">Centre:</label>
        <input type="text" id="centre" name="centre_name" class="form-control"><br>
        
        <button type="submit" class="btn btn-primary" style="margin-left:180px">Submit</button>
    </form>
            </div>
        </div>
    </div>
</div> 
<!-- Company smodal -->
<div class="modal fade" id="CompanyDetailsModal" tabindex="-1" aria-labelledby="#CompanyDetailsModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h1 class="modal-title fs-5 text-light" id="CompanyDetailsModalLabel">Add Company</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4" id="CompanyDetails">
    <form id="CompanyForm">
         @csrf      
        
        <label for="Company">Company:</label>
        <input type="text" id="Company" name="company_name" class="form-control"><br>
        
        <button type="submit" class="btn btn-primary" style="margin-left:180px">Submit</button>
    </form>
            
            </div>
        </div>
    </div>
</div> 


<!--edit subcentre form --> 
<div class="modal fade EditsubcentreDetails" id="EditsubcentreDetailsModal" tabindex="-1" aria-labelledby="EditsubcentreDetailsModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h1 class="modal-title fs-5 text-light" id="EditsubcentreDetailsModal">Edit subcentre</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4" id="EditsubcentreDetails">
            <form id="EditsubcentreForm" action="" method="POST">
              @csrf
            <div class="row align-items-start justify-content-start">
                <div class="col-11">
                <label>Company:</label>
                <select id="Company-edit" name="Company_id" class="form-select">
                @foreach($company as $com)
                <option value="{{ $com->Company_id }}">{{ $com->Company_name }}</option>
                @endforeach
              </select><br>
                </div>
                <div class="col-1 text-start mt-3">
               
                </div>
            </div>
           
            
    <div class="row align-items-start justify-content-start">
        <div class="col-11">
            <label for="centre-select">centre:</label>
            <select id="centre-edit" name="centreId" class="form-select">
                <option value=""></option>
            </select>
        </div>
        <div class="col-1 text-start mt-3">
          
            
        </div>
    </div>
<div class="row align-items-start justify-content-start">
    <div class="col-11">
    <label>subcentre:</label>
            <input type="text" name="subcentre_edit" class="form-control" id="subcentre-edit">
    </div>
    <div class="col-1 text-start mt-3">
    
    </div>
</div>    
<div class="row align-items-start justify-content-start">
    <div class="col-12">
    <label>Remarks:</label>
            <input type="text" name="remarks" id="remarkon" class="form-control" >
    </div>
   
</div>   
        <input type="hidden" name="subcentreId" id="editsubcentreId">
        <button type="submit" class="btn btn-primary mt-2" style="margin-left:290px">Submit</button>
            </form>
            </div>
        </div>
    </div>
</div> 
<div class="modal fade" id="centreDetailsModal" tabindex="-1" aria-labelledby="centreDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h1 class="modal-title fs-5 text-light" id="centreDetailsModalLabel">Add centre</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4" id="centreDetails">
            <form id="centreForm" method="POST">
            @csrf
        
        <label for="centre">Company:</label>
        <select id="Company1" name="Company_id" class="form-control">

        </select><br>
        
        <label for="centre">centre:</label>
        <input type="text" id="centre" name="centre_name" class="form-control"><br>
        
        <button type="submit" class="btn btn-primary" style="margin-left:180px">Submit</button>
    </form>
            </div>
        </div>
    </div>
</div> 

@endsection  


@section('data_table')
<div class="row">  
    <div class="col-12">
        <div class="card">   
            <div class="card-header">
                <caption><h3 class="mt-3 rounded-3">SUBCENTRES</h3></caption> 
                </div>  
    <div class="row">
        <div class="col-1"></div>
        <div class="col-lg-10 col-md-10 col-xs-8 col-sm-8">
                                  
                <div class="card-body">
                    
                    <table id="subcentreTable" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr class="head-color"> 
                                <th class="text-light">S.No</th>                                            
                                <th class="text-light">Company</th>
                                <th class="text-light">Centre</th>
                                <th class="text-light">Sub Centre</th>
                                <th class="text-light">Remarks</th>
                                <th class="text-light">Action</th>                                                
                            </tr>
                        </thead>
                        <tbody>
                           <tr>
                            
                            <td></td>
                            <td class="text-wrap"></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                           </tr>
                            
                        </tbody>
                    </table>

                </div> <!-- end card body-->
            </div> <!-- end card -->
            <div class="col-1"></div>
        </div><!-- end col-->
        
    </div>
   
    </div>
 </div>
@endsection 



@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

   <!-- Datatables js -->
<script src="{{ asset('assets/vendor/datatables.net/js/jquery.dataTables.min.js') }}"></script> <!-- Core DataTables library -->
<script src="{{ asset('assets/vendor/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') }}"></script> 
<script src="{{ asset('assets/vendor/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script> <!-- Bootstrap 5 integration -->
<script src="{{ asset('assets/vendor/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script> <!-- Responsive extension -->
<script src="{{ asset('assets/vendor/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script> <!-- Bootstrap 5 integration for responsive -->
<script src="{{ asset('assets/vendor/datatables.net-fixedcolumns-bs5/js/fixedColumns.bootstrap5.min.js') }}"></script> <!-- Fixed columns extension -->
<!-- Fixed header extension -->
<script src="{{ asset('assets/vendor/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script> <!-- Buttons extension -->
<script src="{{ asset('assets/vendor/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js') }}"></script> <!-- Bootstrap 5 integration for buttons -->
<script src="{{ asset('assets/vendor/datatables.net-buttons/js/buttons.html5.min.js') }}"></script> <!-- HTML5 export button -->
<script src="{{ asset('assets/vendor/datatables.net-buttons/js/buttons.flash.min.js') }}"></script> <!-- Flash export button -->
<script src="{{ asset('assets/vendor/datatables.net-buttons/js/buttons.print.min.js') }}"></script> <!-- Print button -->
<script src="{{ asset('assets/vendor/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script> <!-- Keyboard navigation extension -->
<script src="{{ asset('assets/vendor/datatables.net-select/js/dataTables.select.min.js') }}"></script> <!-- Select extension -->



<!-- Datatable Demo App js -->
<script src="{{ asset('assets/js/pages/datatable.init.js') }}"></script> <!-- Initialization script for DataTables -->

<!-- App js -->


<script>
 
 $(document).ready(function() {
    var table = $('#subcentreTable').DataTable();
    new $.fn.dataTable.FixedHeader(table);
});

    $(document).ready(function() {
    $('#subcentreTable').DataTable({
        
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
                title:'subcentres',
                titleAttr: 'Export to CSV',
                className: 'custombutton',
            }
        ],
        lengthMenu: [
            [10, 25, 50, -1],
            ['10 subcentres', '25 subcentres', '50 subcentres', 'All subcentres']
        ],
        ajax: {
           url: `{{ url('/admin/subcentre/datatable') }}`,
            type: 'GET',
            dataSrc: 'data'
        },
        columns: [
            {
            name: 'serial_no',
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1; // Calculate the serial number
                }
            },
            { data: 'company_name' },
            { data: 'centre_name' },
            { data: 'subcentre_name' },
            { data: 'remarks'},
            {
                data: null,
                name: 'action',
                orderable: false,
                searchable: false,
                render: function(data, type, row, meta) {
                    return `
                        <div class="dd d-flex">                    
                            <button class="btn btn-warning btn-sm edit-subcentre me-1" data-id="${row.subcentre_id}">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <button class="btn btn-danger btn-sm delete-subcentre" data-id="${row.subcentre_id}">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    `;
                }
            },
        ]
    });
});

    
//getting the value of search box
///subcentre/select
    $(document).ready(function() {
    $('#company-select').change(function(){
        $.ajax({
               url: "{{ url('/admin/centre/select') }}?company_id=" + $(this).val(),
                method: 'GET',
                success: function(data) {
                    $('#centre-select').find('option').remove().end();
                    $('#centre-select').html(data.html);
                }
            });      


         });
    });
    $(document).ready(function() {
    $.ajax({
        url: `{{ url('/admin/companies/get')}}`,
        method: 'GET',
        success: function(data) {
            console.log(data); // Log data to ensure it's correctly fetched           
            var CompanySelect = $('#Company1');        
             data.forEach(function(Company) {
                // Create an <option> element with Company_name as text and Company_id as value
                var option = $('<option></option>')
                    .val(Company.company_id) // Set value attribute
                    .text(Company.company_name); // Set visible text
                CompanySelect.append(option); // Append the option to the select element
            });
               
        },
        error: function(error) {
            console.log("Error fetching categories:", error);
        }
    });


//add centre 
$('#centreForm').on('submit', function(event) {
        event.preventDefault();
        var formData = $(this).serialize();
        // console.log(formData); // Log form data to ensure it's correctly serialized
        
        $.ajax({
            url: `{{ url('/admin/centres/new')}}`,
            method: 'POST',
            data: formData,
            success: function(response) {
                $('#centreDetailsModal').modal('hide');
                alert(response.message);
            },
            error: function(error) {
                console.log("Error submitting subcentre:", error);
            }
        });
    });
});  

$('#CompanyForm').on('submit', function(event) {
        event.preventDefault();
        var formData = $(this).serialize();
              
        $.ajax({
            url: `{{ url('/admin/company/new')}}`,
            method: 'POST',
            data: formData,
            success: function(response) { 
                $('#CompanyDetailsModal').modal('hide');
                alert(response.message);
                $('#CompanyForm')[0].reset();
            },
            error: function(error) {
                console.log("Error submitting subcentre:", error);
            }
        });
    });

    $('#AddsubcentreForm').on('submit', function(event) {
    event.preventDefault();
    var formData = $(this).serialize();
              
    $.ajax({
        url: `{{ url('/admin/subcentre/new' )}}`,
        method: 'POST',
        data: formData,
        dataType: 'json',  // Expect JSON response
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            if (response.status == 0) {
                $.each(response.error, function(prefix, val) {
                    $('#' + prefix + '-error').text(val[0]);
                });
            } else if (response.status == 1) {
                $('#CompanysubcentreDetailsModal').modal('hide');
                $('#AddsubcentreForm')[0].reset();
                toastr.success(response.message);
                setTimeout(function() {
                    location.reload();
                }, 2000);
            }
        },
        error: function(error) {
            console.log("Error submitting subcentre:", error);
        }
    });
});

    //edit subcentre 
  //id="subcentreDetailsModal" class="subcentreDetail"
$("#subcentreData").on("click", ".edit-subcentre", function(e){
              e.preventDefault();
              var subcentreId = $(this).data('id');
              $('.EditsubcentreDetails').find('form')[0].reset();
              $('.EditsubcentreDetails').find('span.error_text').text('');
               $('#EditsubcentreDetailsModal').modal('show');
              $.ajax({
                  method: "GET",
                  headers: {
                      Accept: "application/json"
                  },
           
                  data: {
                      "_token": "{{ csrf_token() }}",
                      id: subcentreId,
                  },
                  dataType: 'json',
                  success: function(res) 
                  {               
                    $('#editsubcentreId').val(res.subcentre_id);
                    $('#Company-edit option[value="'+res.Company_id+'"]').attr("selected", "selected"); 
                    
                    $('#centre-edit option[value="'+res.centreId+'"]').attr("selected", "selected"); 
  
                    $('#subcentre-edit').val(res.subcentre_name);  
                    $('#remarkon').val(res.remarks);             
                   $('#EditsubcentreDetailsModal').modal('show');
                  }

              })
              $('#Company-edit').change(function(){
   
            $.ajax({
           
                method: 'GET',
                success: function(data) {
                    $('#centre-edit').find('option').remove().end();
                    $('#centre-edit').html(data.html);
                }
            });            
        
        });
      
        });
//update subcentre  

$(document).ready(function() {
    $('#EditsubcentreForm').on('submit', function(e) {
        e.preventDefault();
        var form = this;
        let formData = $(this).serializeArray();

        $.ajax({
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "",
            data: formData,
            dataType: 'json',
            beforeSend: function() {
                $(form).find('span.error-text').text('');
            },
            success: function(data) {
                if (data.status == 0) {
                    $.each(data.error, function(prefix, val) {
                        $('#' + prefix + '-error').text(val[0]);
                    });
                } else if(data.status == 1) {
                    $('#EditsubcentreDetailsModal').modal('hide');
                    $('#EditsubcentreForm')[0].reset();
                    toastr.success(data.message);
                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                }
            }
        });
    });
});









//delete subcentre
 
$(document).on('click', '.delete-subcentre', function() {
    const subcentreId = $(this).data('id');
    if(confirm('Are you sure you want to delete this subcentre?')) {
        $.ajax({

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
                $('#subcentreData').DataTable().ajax.reload();
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
