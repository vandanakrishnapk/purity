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
        <h3 class="text-start mt-3 rounded-3">CORPORATE CUSTOMERS</h3>
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
                            <th class="text-light">Category</th>
                            <th class="text-light">Sub Category</th>
                            <th class="text-light">Product</th>
                            <th class="text-light">Located On</th>
                            <th class="text-light">Assigned To</th>
                            <th class="text-light">Filter Change On</th>
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
                                        <select id="company-select" name="company_id" class="form-select">
                                            <option value="">Select Company</option>
                                            @foreach($company as $com)
                                            <option value="{{ $com->company_id }}">{{ $com->company_name }}</option>
                                            @endforeach
                                          </select><br><span class="error  text-danger" id="company_name-error"></span>
                                        
                                        <br><label for="center_name">Center Name</label>
                                        <select id="centre-select" name="centre_id" class="form-select">
                                            <option value=""></option>
                                        </select>
                                         <span class="error  text-danger" id="center_name-error"></span>
                                        
                                        <br><label for="sub_center">Sub Center</label>
                                        <select id="subcentre-select" name="subcentre_id" class="form-select">
                                            <option value=""></option>
                                        </select>
                                       <span class="error text-danger" id="sub_center-error"></span>
                                       

                                        <br><label for="sub_center">Located On</label>
                                        <input type="text" name="located_on" id="locatedon" placeholder="Located On" class="form-control">
                                        <span class="error text-danger" id="located_on-error"></span>
                                      
                                        <br>
                                        <h3 class="text-center text-primary p-1 rounded-1 w-50" style="margin-left:150px">Contact Person</h3>
                                        <label for="contact_person">Name</label>
                                        <input type="text" name="contact_person" id="contact_person" placeholder="Name" class="form-control">
                                        <span class="error text-danger" id="contact_person-error"></span>
                                        
                                        <br><label for="contact_mobile">Mobile</label>
                                        <input type="text" name="contact_mobile" id="contact_mobile" placeholder="Mobile" class="form-control">
                                        <span class="error text-danger" id="contact_mobile-error"></span>

                                        <br><label for="center_address">Center Address</label>
                                        <textarea name="center_address" id="center_address" cols="30" rows="5" placeholder="Center Address" class="form-control"></textarea>
                                        <span class="error text-danger" id="center_address-error"></span> 
                    <h3 class="text-center  text-primary p-1 rounded-1 w-50 mt-3" style="margin-left:170px">Product Details</h3>
                                          
                    
                    <div class="form-group mb-2">
                        <label for="category">Category:</label>
                        <select id="category-select" name="category_id" class="form-select fixed-width"
                            style="width:725px !important;">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->category_id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                        <span class="error text-danger" id="category_id-error"></span>
                    </div>
                    <div class="single-row d-flex justify-content-between">

                        <div class="form-group mb-2">
                            <label for="category">Sub Category:</label>
                            <select id="sub-category-select" name="subcat_id" class="form-select fixed-width"
                                style="width:350px !important;">

                                <option value="">Select subcategory</option>

                            </select>
                            <span class="error text-danger" id="subcat_id-error"></span>
                        </div>

                        <div class="form-group mb-2">
                            <label for="product">Product:</label>
                            <select id="product-select" name="product_id" class="form-select fixed-width"
                                style="width:350px !important;">
                                <option value="">Select Product</option>
                                <!-- Products will be loaded here -->
                            </select>

                            {{-- <span class="error text-danger" id="product_id-error"></span> --}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Purchased From</label>
                        <select name="purchased_from" id="purchasedFrom" class="form-select">
                            <option>Select Purchased From</option>
                            <option value="Mukkam">Mukkam</option>
                            <option value="Mavoor">Mavoor</option>
                            <option value="Calicut">Calicut</option>
                        </select>
                    </div>
                                        <h3 class="text-center text-light p-1 rounded-1 w-50" style="margin-left:170px">Installation Details</h3>
                                        <div class="form-group mb-2">
                                            <label for=""> Filter change on </label>
                                            <select name="filter_change_on" id="" class="form-select">
                                                <option value="">Select Filter Change On</option>
                                                <option value="4 Months">4 Months</option>
                                                <option value="8 Months">8 Months</option>
                                                <option value="12 Months">12 Months</option>
                                            </select>
                                            <span class="error text-danger" id="filter_change_on-error"></span>
                                        </div>
                                        <div class="form-group mb-2">
                                            <label for="assigned_to">Assigned to:</label>
                                            <select id="" name="assigned_to" class="form-control">
                                                <option value="">Select Staff</option>
                                                @foreach($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                            <span class="error text-danger " id="assigned_to-error"></span>
                                        </div>
                                          <div class="form-group mb-2">
                                            <label for="remarks">Remarks:</label>
                                            <textarea id="remarks" name="remarks" class="form-control">{{ old('remarks') }}</textarea>
                                            <span class="error text-danger" id="remarks-error "></span>
                                        </div>
                                     
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
    //data table view ,
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
                title: 'Corporate Customers',
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
            { data: 'centre_name', name: 'centre_name' },
            { data: 'subcentre_name', name: 'subcentre_name' },
            { data: 'contact_person', name: 'contact_person' },
            { data: 'contact_mobile', name: 'contact_mobile' },
            { data: 'center_address', name: 'center_address' },
            { data: 'category_name', name: 'category_name' },
            { data: 'subcategory_name', name: 'subcategory_name' },
            { data: 'product_name', name: 'product_name' },
            { data: 'located_on', name: 'located_on' },
            { data: 'name', name: 'name' },
            { data: 'filter_change_on', name: 'filter_change_on' },
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
            },
        ],
        columnDefs: [{ visible: false, targets: [2,3,4,6,7,8,10] }],
    });
});  


//company load  

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
}); 

//company change event for centres 
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
//centre change event to select sub centre 

///subcentre/select
$(document).ready(function() {
    $('#centre-select').change(function(){
        $.ajax({
               url: "{{ url('/admin/subcentre/select') }}?centre_id=" + $(this).val(),
                method: 'GET',
                success: function(data) {
                    $('#subcentre-select').find('option').remove().end();
                    $('#subcentre-select').html(data.html);
                }
            });      


         });
    });
//sub category field change 
$('#category-select').change(function() {
        var categoryId = $(this).val();
        if (categoryId) { // Check if a valid category ID is selected
            $.get(`{{ url('/admin/subcategory/change') }}/` + categoryId, function(sub) {
                var $subcatSelect = $('#sub-category-select');
                $subcatSelect.empty();
                // $productSelect.append('<option value="">Select Product</option>');
                $subcatSelect.append('<option>Select Sub Category</option>');
                $.each(sub, function(index, subcat) {
                   
                    $subcatSelect.append('<option value="' + subcat.subcat_id + '">' + subcat.subcategory_name + '</option>');
                });
            }).fail(function() {
                console.log('Failed to fetch products.'); // Handle any errors
            });
        } else {
            $('#sub-category-select').empty().append('<option value="">Select sub category</option>'); // Clear products if no category is selected
        }
    }); 
    
    $('#sub-category-select').change(function() {
        var subcategoryId = $(this).val();
        if (subcategoryId) { // Check if a valid category ID is selected
            $.get(`{{ url('/admin/products') }}/` + subcategoryId, function(products) {
                var $productSelect = $('#product-select');
                $productSelect.empty();
                // $productSelect.append('<option value="">Select Product</option>');
                $productSelect.append('<option> Select product</option>');
                $.each(products, function(index, product)
                 {
                    
                    $productSelect.append('<option value="' + product.product_id + '">' + product.product_name + '</option>');
                });
            }).fail(function() {
                console.log('Failed to fetch products.'); // Handle any errors
            });
        } else {
            $('#product-select').empty().append('<option value="">Select Product</option>'); // Clear products if no category is selected
        }
    });



//filter change on to date 
function updateNextService() {
            const filterchangeonValue = $('#filterchangeon').val();
            const today = new Date();
            const result = $('#result');
            let endDate;

            if (filterchangeonValue) {
                // Calculate the end date based on the selected filterchangeon
                endDate = new Date(today.setMonth(today.getMonth() + parseInt(filterchangeonValue, 10)));
                $('#filterchange').val(`${endDate.toISOString().split('T')[0]}`);
            }
           }

        $('#filterchangeon').on('change', updateNextService);

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
    $.each(response.errors, function(key, value) {
        $('#' + key + '-error').text(value[0]);
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

            if (data && data.companyPurchase) 
            {
                const company = data.companyPurchase;

                let corporateDetails = `
                    <ul class="list-group">
                            <li class="list-group-item"><p class="m-0">
                    <div class="row">
                        <div class="col-5">
                              <strong>Company Name</strong>
                        </div>
                        <div class="col-1">:</div>
                        <div class="col-4">
                             ${company.company_name}                          
                        </div>
                    </div>
                    </li>

                        <li class="list-group-item"><p class="m-0">
                    <div class="row">
                        <div class="col-5">
                              <strong>Center Name</strong>
                        </div>
                        <div class="col-1">:</div>
                        <div class="col-4">
                             ${company.centre_name}                          
                        </div>
                    </div>
                    </li>

                        <li class="list-group-item"><p class="m-0">
                    <div class="row">
                        <div class="col-5">
                              <strong>Sub Center</strong>
                        </div>
                        <div class="col-1">:</div>
                        <div class="col-4">
                             ${company.subcentre_name}                          
                        </div>
                    </div>
                    </li>

                        <li class="list-group-item"><p class="m-0">
                    <div class="row">
                        <div class="col-5">
                              <strong>Contact Person</strong>
                        </div>
                        <div class="col-1">:</div>
                        <div class="col-4">
                             ${company.contact_person}                          
                        </div>
                    </div>
                    </li>
                      
                    
                        <li class="list-group-item"><p class="m-0">
                    <div class="row">
                        <div class="col-5">
                              <strong>Contact Mobile</strong>
                        </div>
                        <div class="col-1">:</div>
                        <div class="col-4">
                             ${company.contact_mobile}                          
                        </div>
                    </div>
                    </li>

                        <li class="list-group-item"><p class="m-0">
                    <div class="row">
                        <div class="col-5">
                              <strong>Center Address</strong>
                        </div>
                        <div class="col-1">:</div>
                        <div class="col-4">
                             ${company.center_address}                          
                        </div>
                    </div>
                    </li>

                        <li class="list-group-item"><p class="m-0">
                    <div class="row">
                        <div class="col-5">
                              <strong>Category</strong>
                        </div>
                        <div class="col-1">:</div>
                        <div class="col-4">
                             ${company.category_name}                          
                        </div>
                    </div>
                    </li>

                        <li class="list-group-item"><p class="m-0">
                    <div class="row">
                        <div class="col-5">
                              <strong>Sub category</strong>
                        </div>
                        <div class="col-1">:</div>
                        <div class="col-4">
                             ${company.subcategory_name}                          
                        </div>
                    </div>
                    </li>

                        <li class="list-group-item"><p class="m-0">
                    <div class="row">
                        <div class="col-5">
                              <strong>Product</strong>
                        </div>
                        <div class="col-1">:</div>
                        <div class="col-4">
                             ${company.product_name}                          
                        </div>
                    </div>
                    </li>  

                            <li class="list-group-item"><p class="m-0">
                    <div class="row">
                        <div class="col-5">
                              <strong>Located On</strong>
                        </div>
                        <div class="col-1">:</div>
                        <div class="col-4">
                             ${company.located_on}                          
                        </div>
                    </div>
                    </li> 
                    
                    
                        <li class="list-group-item"><p class="m-0">
                    <div class="row">
                        <div class="col-5">
                              <strong>Purchased From</strong>
                        </div>
                        <div class="col-1">:</div>
                        <div class="col-4">
                             ${company.purchased_from}                          
                        </div>
                    </div>
                    </li>

                        <li class="list-group-item"><p class="m-0">
                    <div class="row">
                        <div class="col-5">
                              <strong>Filter Change On</strong>
                        </div>
                        <div class="col-1">:</div>
                        <div class="col-4">
                             ${company.filter_change_on}                          
                        </div>
                    </div>
                    </li>

                        <li class="list-group-item"><p class="m-0">
                    <div class="row">
                        <div class="col-5">
                              <strong>Assigned</strong>
                        </div>
                        <div class="col-1">:</div>
                        <div class="col-4">
                             ${company.name}                          
                        </div>
                    </div>
                    </li>
                       
                    </ul>
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
    
   $.get(`{{ url('/admin/purchase/company/edit') }}/${userId}`, function(data) {
       
        const formHtml = `
            <form id="editCompanyForm" data-id="${data.corporate_id}">
            @csrf
            <h3 class="text-center text-primary p-1 rounded-1 w-50" style="margin-left:150px">Corporate Company</h3>
                <div class="mb-3">
                    <label for="company_name" class="form-label">Company Name</label>
                   <select id="edit-company-select" name="company_id" class="form-select">                 
                    <option value="${data.company_id}">${data.company_name}</option>
                    @foreach($company as $com)
                    <option value="{{ $com->company_id }}">{{ $com->company_name }}</option>
                    @endforeach
                    </select><br><span class="error  text-danger" id="company_name-error"></span>
                                        
                    <br><label for="center_name">Center Name</label>
                    <select id="edit-centre-select" name="centre_id" class="form-select"> 
                        <option value="">Select Centre</option>                   
                     <option value="${data.centre_id}">${data.centre_name}</option>
                    
                    </select>
                    <span class="error  text-danger" id="center_name-error"></span>
                                        
                     <br><label for="sub_center">Sub Center</label>
                    <select id="edit-subcentre-select" name="subcentre_id" class="form-select"> 
                    <option value="">Select Sub Centre</option>                  
                    <option value="${data.subcentre_id}">${data.subcentre_name}</option>                    
                    </select>
                    <span class="error text-danger" id="sub_center-error"></span>                                       

                    <br><label for="sub_center">Located On</label>
                    <input type="text" name="located_on" id="locatedon" value="${data.located_on}" placeholder="Located On" class="form-control">
                    <span class="error text-danger" id="located_on-error"></span>
                                      
                                        
                    <h3 class="text-center text-primary p-1 rounded-1 w-50" style="margin-left:150px">Contact Person</h3>
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
                     <h3 class="text-center  text-primary p-1 rounded-1 w-50 mt-3" style="margin-left:170px">Product Details</h3>
                  </div>  <div class="form-group mb-2">
                                            <label for="category">Category:</label>
                                            <select id="edit-category-select" name="category_id" class="form-select fixed-width"
                                                style="width:725px !important;">
                                                <option value="${data.category_id}">${data.category_name}</option>
                                                @foreach($categories as $category)
                                                <option value="{{ $category->category_id }}">{{ $category->category_name }}</option>
                                                @endforeach
                                            </select>
                                            <span class="error text-danger" id="category-error"></span>
                                        </div>
                                        <div class="single-row d-flex justify-content-between">
                    
                                            <div class="form-group mb-2">
                                                <label for="category">Sub Category:</label>
                                                <select id="edit-sub-category-select" name="subcat_id" class="form-select fixed-width"
                                                    style="width:350px !important;">
                    
                                                    <option value="${data.subcategory_id}">${data.subcategory_name}</option>
                    
                                                </select>
                                                <span class="error text-danger" id="category-error"></span>
                                            </div>
                    
                                            <div class="form-group mb-2">
                                                <label for="product">Product:</label>
                                                <select id="edit-product-select" name="product_id" class="form-select fixed-width"
                                                    style="width:350px !important;">
                    
                                                    <option value="${data.product_id}">${data.product_name}</option>
                                                    <!-- Products will be loaded here -->
                                                </select>
                    
                                                <span class="error text-danger" id="product-error"></span>
                                            </div>
                                        </div>  

                                        
                                           



                                          <div class="form-group">
                        <label for="">Purchased From</label>
                        <select name="purchased_from" id="purchasedFrom" class="form-select">
                            <option value="${data.purchased_from}">${data.purchased_from}</option>
                            <option value="Mukkam">Mukkam</option>
                            <option value="Mavoor">Mavoor</option>
                            <option value="Calicut">Calicut</option>
                        </select>
                    </div>

                                        <h3 class="text-center text-light p-1 rounded-1 w-50" style="margin-left:170px">Installation Details</h3>
                                        <div class="form-group mb-2">
                                            <label for=""> Filter change on </label>
                                            <select name="filter_change_on" id="edit-filter-change" class="form-select">
                                                <option value="${data.filter_change_on}">${data.filter_change_on}</option>
                                                <option value="4 Months">4 Months</option>
                                                <option value="8 Months">8 Months</option>
                                                <option value="4 Months">12 Months</option>
                                            </select>
                                        </div>
                                        <div class="form-group mb-2">
                                            <label for="assigned_to">Assigned to:</label>
                                            <select id="edit-assigned_to1" name="assigned_to" class="form-control">
                                                <option value="">${data.name}</option>
                                                @foreach($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                            <span class="error text-danger" id="assigned_to-error"></span>
                                        </div>           
                                            <button type="submit" class="btn btn-primary" style="margin-left:260px;">Save changes</button>
            </form>
        `;
        
        // Inject the form HTML into the modal
        $('#editDetails').html(formHtml);

        // Show the modal
        $('#editDetailsModal').modal('show');
        $('#edit-sub-category-select').change(function() {
        var categoryId = $(this).val();
        if (categoryId) { // Check if a valid category ID is selected
            $.get(`{{ url('/admin/products') }}/` + categoryId, function(products) {
                var $productSelect = $('#edit-product-select');
                $productSelect.empty();
                $productSelect.append('<option value="">Select Product</option>');
                $.each(products, function(index, product) {
                    $productSelect.append('<option value="' + product.product_id + '">' + product.product_name + '</option>');
                });
            }).fail(function() {
                console.log('Failed to fetch products.'); // Handle any errors
            });
        } else {
            $('#edit-product-select').empty().append('<option value="">Select Product</option>'); // Clear products if no category is selected
        }
    });
//sub category field change 
$('#edit-category-select').change(function() {
        var categoryId = $(this).val();
        if (categoryId) { // Check if a valid category ID is selected
            $.get(`{{ url('/admin/subcategory/change') }}/` + categoryId, function(sub) {
                var $subcatSelect = $('#edit-sub-category-select');
                $subcatSelect.empty();
                $subcatSelect.append('<option value="">Select Sub Category</option>');
                $.each(sub, function(index, subcat) {
                    $subcatSelect.append('<option value="' + subcat.subcat_id + '">' + subcat.subcategory_name + '</option>');
                });
            }).fail(function() {
                console.log('Failed to fetch products.'); // Handle any errors
            });
        } else {
            $('#edit-sub-category-select').empty().append('<option value="">Select sub category</option>'); // Clear products if no category is selected
        }
    });    

    $('#edit-company-select').change(function(){
        $.ajax({
               url: "{{ url('/admin/centre/select') }}?company_id=" + $(this).val(),
                method: 'GET',
                success: function(data) {
                    $('#edit-centre-select').find('option').remove().end();
                    $('#edit-centre-select').html(data.html);
                }
            });      
         });

    $('#edit-centre-select').change(function(){
        $.ajax({
               url: "{{ url('/admin/subcentre/select') }}?centre_id=" + $(this).val(),
                method: 'GET',
                success: function(data) {
                    $('#edit-subcentre-select').find('option').remove().end();
                    $('#edit-subcentre-select').html(data.html);
                }
            });    
         });
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