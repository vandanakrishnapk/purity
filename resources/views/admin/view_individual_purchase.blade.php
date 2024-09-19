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
        <h3 class="text-start mt-3 rounded-3">INDIVIDUAL CUSTOMERS</h3>
    </div>
    <div class="card-body P-2">

        <table id="example" class="table table-striped dt-responsive nowrap w-100">
            <thead class="bg-dark">
                <tr>
                    <th class="text-light">S.No</th>
                    <th class="text-light">Customer ID</th>
                    <th class="text-light">Name</th>
                    <th class="text-light">Address</th>
                    <th class="text-light">Mobile</th>
                    <th class="text-light">Whatsapp</th>                    
                    <th class="text-light">Premier Customer</th>                    
                    <th class="text-light">Landmark</th>
                    <th class="text-light">Category</th>
                    <th class="text-light">Sub Category</th>
                    <th class="text-light">Product</th>
                    <th class="text-light">Purchased From</th>
                    <th class="text-light">Filter Change On</th>
                    <th class="text-light">Assigned To</th>
                    <th class="text-light">Remarks</th>
                    <th class="text-light">Action</th>
                </tr>
            </thead>
            <tbody>
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
                <td></td>
                <td></td>
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('modal')
<button type="button" class="btn btn-primary float-end add-user-btn" data-bs-toggle="modal"
    data-bs-target="#exampleModal" style="margin-left:138px">
    <span class="plus-symbol">+</span>
</button>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg custom-modal">
        <div class="modal-content">
            <div class="modal-header bg-primary text-light">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Individual Customer</h1>
                <button type="button" class="btn-close text-light" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">

                <form id="myForm">
                    @csrf
                    <h3 class="text-center text-primary p-1 rounded-1 w-50" style="margin-left:170px">Customer Details</h3><br>
                    <div class="single-row d-flex justify-content-between">
                        
                        <div class="form-group mb-2">
                            <label for="name">Name:</label>
                            <input type="text" id="p_name" name="p_name" class="form-control" value="{{ old('name') }}"
                                style="width:350px !important;">
                            <span class="error text-danger" id="p_name-error"></span>
                        </div>
                        <div class="form-group mb-2">
                            <label for="mobile">Mobile:</label>
                            <input type="text" id="mobile" name="mobile" class="form-control"
                                value="{{ old('mobile') }}" style="width:350px !important;">
                            <span class="error text-danger" id="mobile-error"></span>
                        </div>
                    </div>


                    <div class="form-group mb-2">
                        <label for="address">Address:</label>
                        <textarea id="address" name="address" class="form-control">{{ old('address') }}</textarea>
                        <span class="error text-danger" id="address-error"></span>
                    </div>



                    <div class="form-group mb-2">
                        <label for="whatsapp">Premier Customer</label>
                        <input type="radio" name="premier_customer" class="form-check-input" value="Yes"><span class="ms-1 me-5">Yes</span>
                        <input type="radio" name="premier_customer" class="form-check-input" value="No"><span class="ms-1 me-5">No</span>
                       
                        <span class="error text-danger" id="premier_customer-error"></span>
                    </div> 

                    <div class="form-group mb-2">
                        <label for="whatsapp">WhatsApp:</label>
                        <input type="text" id="whatsapp" name="whatsapp" class="form-control"
                            value="{{ old('whatsapp') }}">
                        <span class="error text-danger" id="whatsapp-error"></span>
                    </div>



                    <div class="form-group mb-2">
                        <label for="landmark">Landmark:</label>
                        <input type="text" id="landmark" name="landmark" class="form-control"
                            value="{{ old('landmark') }}">
                        <span class="error text-danger" id="landmark-error"></span>
                    </div>
                    <h3 class="text-center  text-primary p-1 rounded-1 w-50 mt-3" style="margin-left:170px">Product Details</h3>
                    
                    <div class="form-group mb-2">
                        <label for="Type of Purchase">Type of Purchase</label> 
                        <div class="custom-radio mt-2">                       
                        <input type="radio" name="type_of_purchase" class="form-check-input" value="New Purchase"><span class="ms-1 me-5">New Purchase</span>
                        <input type="radio" name="type_of_purchase" class="form-check-input" value="Old Purchase"><span class="ms-1 me-5">Old Purchase</span>
                        <input type="radio" name="type_of_purchase" class="form-check-input" value="Outside Purchase"><span class="ms-1">Outside Purchase</span>
                        </div>
                       
                        <span class="error text-danger" id="type_of_purchase-error"></span>
                    </div>
                    
                    
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
                        <select name="purchased_from" id="purchasedFrom" class="form-select fixed-width">
                            <option>Select Purchased From</option>
                            <option value="Mukkam">Mukkam</option>
                            <option value="Mavoor">Mavoor</option>
                            <option value="Calicut">Calicut</option>
                        </select>
                    </div>
                  

                    <h3 class="text-center  text-primary p-1 rounded-1 w-50 mt-3" style="margin-left:170px">Installation Details</h3>
                    <div class="form-group mb-2">
                        <label for=""> Filter change on </label>
                        <select name="filter_change_on" id="" class="form-select">
                            <option value="">Select Filter Change On</option>
                            <option value="4 Months">4 Months</option>
                            <option value="8 Months">8 Months</option>
                            <option value="4 Months">12 Months</option>
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
                        <span class="error text-danger" id="assigned_to-error"></span>
                    </div>

                    <div class="form-group mb-2">
                        <label for="remarks">Remarks:</label>
                        <textarea id="remarks" name="remarks" class="form-control">{{ old('remarks') }}</textarea>
                        <span class="error text-danger" id="remarks-error"></span>
                    </div>
            </div>
            <div class="modal-footer">

                <button type="submit" class="btn btn-primary submit-application">Submit</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- modal for view purchase details -->
<div class="modal fade" id="purchaseDetailsModal" tabindex="-1" aria-labelledby="purchaseDetailsModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h1 class="modal-title fs-5 text-light" id="purchaseDetailsModalLabel">Customer Details</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4" id="purchaseDetails">
                <!-- purchase details will be loaded here -->
            </div>
        </div>
    </div>
</div>
<!-- edit individual purchase details modal -->
<div class="modal fade editPurchaseModal" id="editDetailsModal" tabindex="-1" aria-labelledby="editDetailsModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h1 class="modal-title fs-5 text-light" id="editDetailsModalLabel">Edit purchase</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4" id="editDetails">
                <form id="editMyForm" class="editPurchaseDetails" action="{{ route('admin.purchases.update') }}"
                    method="POST">
                    @csrf
                    <input type="hidden" id="purchase_edit_id" name="purchase_edit">
                    
                    <h3 class="text-center text-light p-1 rounded-1 w-50" style="margin-left:170px">Customer Details</h3>
                 
                            <div class="form-group mb-2">
                                <label for="name">Purchase Date</label>
                                <input type="date" id="dop" name="purchase_date" class="form-control me-2">
                                <span class="error text-danger" id="p_name-error"></span>
                            </div>
                    
                    <div class="single-row d-flex justify-content-between">                        
                        <div class="form-group mb-2">
                            <label for="name">Name:</label>
                            <input type="text" id="p_name1" name="p_name" class="form-control me-2"
                                style="width:350px !important;">
                            <span class="error text-danger" id="p_name-error"></span>
                        </div>
                        <div class="form-group">
                            <label for="mobile">Mobile:</label>
                            <input type="text" id="mobile1" name="mobile" class="form-control"
                                style="width:350px !important;">
                            <span class="error text-danger" id="mobile-error"></span>
                        </div>
                    </div>


                    <div class="form-group mb-2">
                        <label for="address">Address:</label>
                        <textarea id="address1" name="address" class="form-control"></textarea>
                        <span class="error text-danger" id="address-error"></span>
                    </div>



                    <div class="form-group mb-2">
                        <label for="whatsapp">WhatsApp:</label>
                        <input type="text" id="whatsapp1" name="whatsapp" class="form-control">
                        <span class="error text-danger" id="whatsapp-error"></span>
                    </div> 
                    <div class="form-group mb-2">
                        <label for="whatsapp">Premier Customer</label>
                        <input type="radio" name="premier_customer" class="form-check-input" value="Yes"><span class="ms-1 me-5">Yes</span>
                        <input type="radio" name="premier_customer" class="form-check-input" value="No"><span class="ms-1 me-5">No</span>
                       
                        <span class="error text-danger" id="premier_customer-error"></span>
                    </div>

                    <div class="form-group mb-2">
                        <label for="landmark">Landmark:</label>
                        <input type="text" id="landmark1" name="landmark" class="form-control">
                        <span class="error text-danger" id="landmark-error"></span>
                    </div>
                    <h3 class="text-center  text-light p-1 rounded-1 w-50" style="margin-left:170px">Product Details</h3>
                    
                    <div class="form-group mb-2">
                        <label for="landmark">Type of Purchase</label> 
                        <div class="custom-radio mt-2">                      
                        <input type="radio" name="type_of_purchase" class="form-check-input" value="New Purchase"><span class="ms-1 me-5">New Purchase</span>
                        <input type="radio" name="type_of_purchase" class="form-check-input" value="Old Purchase"><span class="ms-1 me-5">Old Purchase</span>
                        <input type="radio" name="type_of_purchase" class="form-check-input" value="Outside Purchase"><span class="ms-1">Outside Purchase</span>
                        </div>
                       
                        <span class="error text-danger" id="landmark-error"></span>
                    </div>
                    
                    <div class="form-group mb-2">
                        <label for="category">Category:</label>
                        <select id="category-select1" name="category_id" class="form-select cat-select"
                            style="width:730px !important;">

                            @foreach($categories as $category)
                            <option value="{{ $category->category_id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                        <span class="error text-danger" id="category-error"></span>
                    </div>
                    <div class="single-row d-flex justify-content-between">
                        <div class="form-group mb-2">
                            <label for="category">Sub Category:</label>

                            <select id="sub-category" name="subcat_id" class="form-select fixed-width"
                                style="width:350px !important;">
                                <option value=""></option>
                            </select>

                            <span class="error text-danger" id="category-error"></span>
                        </div>

                        <div class="form-group mb-2">
                            <label for="product">Product:</label>
                            <select id="product-select1" name="product_id" class="form-select fixed-width"
                                style="width:350px !important;">

                                <option value=""></option>
                                <!-- Products will be loaded here -->
                            </select>

                            {{-- <span class="error text-danger" id="product-error"></span> --}}
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
                        <select name="filter_change_on" id="filteron" class="form-select">
                            <option value="">Select Filter Change On</option>
                            <option value="4 Months">4 Months</option>
                            <option value="8 Months">8 Months</option>
                            <option value="4 Months">12 Months</option>
                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <label for="assigned_to">Assigned to:</label>
                        <select id="assigned_to1" name="assigned_to" class="form-control">
                            @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        <span class="error text-danger" id="assigned_to-error"></span>
                    </div>

                    <div class="form-group mb-2">
                        <label for="remarks">Remarks:</label>
                        <textarea id="remarks1" name="remarks" class="form-control"></textarea>
                        <span class="error text-danger" id="remarks-error"></span>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary submit-application">Submit</button>
            </div>
            </form>
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
                {{-- <p>Name: <span id="modalUserName"></span></p>  --}}

                <table class="table table-bordered table-sm">
                    <tr>
                        <th>CustomerId</th>
                        <th><span id="modalCustomerId"></span></th>
                    </tr> 
                    <tr>
                        <th>Name</th>
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

    <!-- Datatable Demo Aapp js -->
   

<script>
   
   $(document).ready(function() {
    $('#example').DataTable({
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
                title:'Individual Customers',
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
        ajax: `{{ url('/admin/purchase/individual') }}`,
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
            {data:  'customerId'},
            { data: 'p_name' },
            { data: 'address' },
            { data: 'mobile' },
            { data: 'whatsapp' },
            {data:'premier_customer'},
            { data: 'landmark' },
            { data: 'category_name' },
            { data: 'subcategory_name'},
            { data: 'product_name' },
            { data: 'purchased_from' },
            { data: 'filter_change_on' },
            { data: 'name' },
            { data: 'remarks' },
            {
                data: null,
                name: 'action',
                orderable: false,
                searchable: false,
                render: function(data, type, row, meta) {
                    const url = baseUrl.replace('ID_PLACEHOLDER', row.individual_id);
                     const isCompleted = row.status === 'completed';
                    return `
                    <div class="dd d-flex">
                        <button class="btn btn-secondary btn-sm more-purchase me-1" data-id="${row.individual_id}">
                            <i class="bi bi-three-dots"></i>
                        </button>
                        <button class="btn btn-warning btn-sm edit-purchase me-1" data-id="${row.individual_id}">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button class="btn btn-danger btn-sm delete-purchase" data-id="${row.individual_id}" data-custid="${row.customerId}" data-cname="${row.p_name}">
                            <i class="bi bi-trash"></i>
                        </button>
                     
                        
                        <a href="${url}" class="btn btn-info ms-1">
                        <i class="ri-folder-history-line"></i>
                        </a>   
                        
                            
                        </div>
                    `;
                }
            },
        ],

     
        columnDefs: [{ visible: false, targets: [3,5,6,7,8,9,11] }],
    });
});

</script>
<!-- 
do individual form -->
<script>
    // Load products based on selected category
    
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
        console.log(subcategoryId);
        if (subcategoryId) { // Check if a valid category ID is selected
            $.get(`{{ url('/admin/products') }}/` + subcategoryId, function(products) {
                var $productSelect = $('#product-select');
                $productSelect.empty();
                // $productSelect.append('<option value="">Select Product</option>');
                $productSelect.append('<option value=""> Select product</option>');
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



// form submission individual 
$(document).ready(function() {
    // Load categories and other options as needed
    
    $('#myForm').on('submit', function(event) {
        event.preventDefault();
        var formData = $(this).serialize();

        $.ajax({
            url: `{{ url('/admin/individual/new') }}`,
            method: 'POST',
            data: formData,
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
                    $('#myForm')[0].reset(); // Clear form fields
                    $('#exampleModal').modal('hide'); // Optionally, close the modal
                    $('#example').DataTable().ajax.reload();
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

//view more individual purchase details 
$(document).on('click', '.more-purchase', function() {
    const purchaseId = $(this).data('id');
    console.log('Clicked purchase ID:', purchaseId);
    if (purchaseId !== undefined) {
        $.get(`{{ url('/admin/purchases') }}/${purchaseId}`, function(data) {
            console.log('Response data:', data);

            if (data && data.p_name && data.address && data.mobile && data.whatsapp && data.landmark && data.category_name && data.product_name && data.purchased_from && data.filter_change_on && data.name && data.remarks) {
                let purchaseDetails = ` 

                 
                <ul class="list-group"> 
                <li class="list-group-item"><p class="m-0">
                    <div class="row">
                        <div class="col-5">
                              <strong>Customer ID</strong>
                        </div>
                        <div class="col-1">:</div>
                        <div class="col-5">
                             ${data.customerId}                          
                        </div>
                    </div>
                    </li>

                        <li class="list-group-item"><p class="m-0">
                    <div class="row">
                        <div class="col-5">
                              <strong>Customer Name</strong>
                        </div>
                        <div class="col-1">:</div>
                        <div class="col-5">
                             ${data.p_name}                          
                        </div>
                    </div>
                    </li>

                        <li class="list-group-item"><p class="m-0">
                    <div class="row">
                        <div class="col-5">
                              <strong>Address</strong>
                        </div>
                        <div class="col-1">:</div>
                        <div class="col-5">
                             ${data.address}                          
                        </div>
                    </div>
                    </li> 

                        <li class="list-group-item"><p class="m-0">
                    <div class="row">
                        <div class="col-5">
                              <strong>Mobile</strong>
                        </div>
                        <div class="col-1">:</div>
                        <div class="col-5">
                             ${data.mobile}                          
                        </div>
                    </div>
                    </li>

                        <li class="list-group-item"><p class="m-0">
                    <div class="row">
                        <div class="col-5">
                              <strong>Whatsapp</strong>
                        </div>
                        <div class="col-1">:</div>
                        <div class="col-5">
                             ${data.whatsapp}                          
                        </div>
                    </div>
                    </li> 

                      <li class="list-group-item"><p class="m-0">
                    <div class="row">
                        <div class="col-5">
                              <strong>Premier Customer</strong>
                        </div>
                        <div class="col-1">:</div>
                        <div class="col-5">
                             ${data.premier_customer}                          
                        </div>
                    </div>
                    </li>
                    

                        <li class="list-group-item"><p class="m-0">
                    <div class="row">
                        <div class="col-5">
                              <strong>Landmark</strong>
                        </div>
                        <div class="col-1">:</div>
                        <div class="col-5">
                             ${data.landmark}                          
                        </div>
                    </div>
                    </li>
                    
                        <li class="list-group-item"><p class="m-0">
                    <div class="row">
                        <div class="col-5">
                              <strong>Category</strong>
                        </div>
                        <div class="col-1">:</div>
                        <div class="col-5">
                             ${data.category_name}                          
                        </div>
                    </div>
                    </li>

                        <li class="list-group-item"><p class="m-0">
                    <div class="row">
                        <div class="col-5">
                              <strong>Subcategory</strong>
                        </div>
                        <div class="col-1">:</div>
                        <div class="col-5">
                             ${data.subcategory_name}                          
                        </div>
                    </div>
                    </li>

                        <li class="list-group-item"><p class="m-0">
                    <div class="row">
                        <div class="col-5">
                              <strong>Product</strong>
                        </div>
                        <div class="col-1">:</div>
                        <div class="col-5">
                             ${data.product_name}                          
                        </div>
                    </div>
                    </li> 
                        <li class="list-group-item"><p class="m-0">
                    <div class="row">
                        <div class="col-5">
                              <strong>Purchased From</strong>
                        </div>
                        <div class="col-1">:</div>
                        <div class="col-5">
                             ${data.purchased_from}                          
                        </div>
                    </div>
                    </li>
                        <li class="list-group-item"><p class="m-0">
                    <div class="row">
                        <div class="col-5">
                              <strong>Filter Change On</strong>
                        </div>
                        <div class="col-1">:</div>
                        <div class="col-5">
                             ${data.filter_change_on}                          
                        </div>
                    </div>
                    </li>

                     <li class="list-group-item"><p class="m-0">
                    <div class="row">
                        <div class="col-5">
                              <strong>Type of Purchase</strong>
                        </div>
                        <div class="col-1">:</div>
                        <div class="col-5">
                             ${data.type_of_purchase}                          
                        </div>
                    </div>
                    </li>

                        <li class="list-group-item"><p class="m-0">
                    <div class="row">
                        <div class="col-5">
                              <strong>Assigned To</strong>
                        </div>
                        <div class="col-1">:</div>
                        <div class="col-5">
                             ${data.name}                          
                        </div>
                    </div>
                    </li>

                        <li class="list-group-item"><p class="m-0">
                    <div class="row">
                        <div class="col-5">
                              <strong>Remarks</strong>
                        </div>
                        <div class="col-1">:</div>
                        <div class="col-5">
                             ${data.remarks}                          
                        </div>
                    </div>
                    </li>
                    
                </ul>
                `;
                $('#purchaseDetails').html(purchaseDetails);
                $('#purchaseDetailsModal').modal('show');
            } else {
                $('#purchaseDetails').html('<p>No purchase details available.</p>');
                $('#purchaseDetailsModal').modal('show');
            }
        }).fail(function() {
            alert('Error retrieving purchase details.');
        });
    } else {
        console.error('purchase ID is undefined.');
    }
});  


//edit individual purchase details 

//modal id = editDetailsModal
//modal class =editPurchaseModal
//datatable = example
//button =edit-purchase


$("#example").on("click", ".edit-purchase", function(e){
              e.preventDefault();
              var purchaseId = $(this).data('id');
              $('.editPurchaseModal').find('form')[0].reset();
              $('.editPurchaseModal').find('span.error_text').text('');
               $('#editDetailsModal').modal('show');
              $.ajax({
                  method: "GET",
                  headers: {
                      Accept: "application/json"
                  },
                  url: `{{ url('/admin/purchases/${purchaseId}/edit') }}`,
                  data: {
                      "_token": "{{ csrf_token() }}",
                      id: purchaseId,
                  },
                  dataType: 'json',
                  success: function(res) 
                  {               
                    $('#purchase_edit_id').val(res.individual_id);
                    $('#dop').val(res.purchase_date);
                    $('#p_name1').val(res.p_name);
                    $('#address1').val(res.address);
                    $('#mobile1').val(res.mobile);
                    $('#whatsapp1').val(res.whatsapp);
                    
                   $('input[name="premier_customer"][value="' + res.premier_customer + '"]').prop('checked', true); 
                    $('#landmark1').val(res.landmark);
                    $('#category-select1 option[value="'+res.category_id+'"]').attr("selected", "selected"); 
                   
                    $('#sub-category option[value="'+res.subcat_id+'"]').attr("selected", "selected").text(res.subcategory_name);
                  
                   
                   $('#product-select1 option[value="'+res.product_id+'"]').attr("selected", "selected");
                 
                   $('#purchasedFrom option[value="'+res.purchased_from+'"]').attr("selected", "selected"); 
                
                   $('#filteron option[value="'+res.filter_change_on+'"]').attr("selected", "selected");
                   $('input[name="type_of_purchase"][value="' + res.type_of_purchase + '"]').prop('checked', true);           
                   $('#assigned_to1 option[value="'+res.assigned_to+'"]').attr("selected", "selected");
                   $('#remarks1').val(res.remarks);                 
                   $('#editDetailsModal').modal('show');
                  }

              });
    //          
               
        
        });
      
        
 $.get('{{ url('/admin/categories') }}', function(categories) {
        var $categorySelect = $('#category-select1');
        $.each(categories, function(index, category) {
            $categorySelect.append('<option value="' + category.category_id + '">' + category.category_name + '</option>');
        });

        // Set the selected category and trigger change to populate subcategories
        $categorySelect.val(response.category_id).change();
    });

    // Handle category change event
    $('#category-select1').change(function() {
        var categoryId = $(this).val();
        if (categoryId) {
            $.get('{{ url('/admin/subcategory/change') }}/' + categoryId, function(subcategories) {
                var $subcatSelect = $('#sub-category');
                $subcatSelect.empty();
                $subcatSelect.append('<option value="">Select Sub Category</option>');
                $.each(subcategories, function(index, subcat) {
                    $subcatSelect.append('<option value="' + subcat.subcat_id + '">' + subcat.subcategory_name + '</option>');
                });

                // Set the selected subcategory and trigger change to populate products
                $subcatSelect.val(response.subcat_id).change();
            }).fail(function() {
                console.log('Failed to fetch subcategories.');
            });
        } else {
            $('#sub-category').empty().append('<option value="">Select Sub Category</option>');
        }
    });

    // Handle subcategory change event
    $('#sub-category').change(function() {
        var subcategoryId = $(this).val();
        if (subcategoryId) {
            $.get('{{ url('/admin/products') }}/' + subcategoryId, function(products) {
                var $productSelect = $('#product-select1');
                $productSelect.empty();
                $productSelect.append('<option value="">Select Product</option>');
                $.each(products, function(index, product) {
                    $productSelect.append('<option value="' + product.product_id + '">' + product.product_name + '</option>');
                });

                // Set the selected product
                $productSelect.val(response.product_id);
            }).fail(function() {
                console.log('Failed to fetch products.');
            });
        } else {
            $('#product-select1').empty().append('<option value="">Select Product</option>');
        }
    });
    $('#category-select1').trigger('change');
 
$(document).ready(function() {
    $('#editMyForm').on('submit', function(e) {
        e.preventDefault();
        var form = this;
        let formData = $(this).serializeArray();

        $.ajax({
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('admin.purchases.update') }}",
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
                } else {
                    $('#editDetailsModal').modal('hide');
                    $('#editMyForm')[0].reset();
                    toastr.success(data.message);
                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                }
            }
        });
    });
});







$(document).on('click', '.delete-purchase', function() {
    const Id = $(this).data('id');
    const userName = $(this).data('cname'); // Assuming you have the username data attribute
    const customerId = $(this).data('custid')
    // Set the user name and message in the modal
    $('#modalCustomerId').text(customerId);
    $('#modalUserName').text(userName);
    $('#modalMessage').text('Are you sure you want to delete this Customer?');

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
            url: `{{ url('/admin/purchases') }}/${Id}`,
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
                $('#example').DataTable().ajax.reload();
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





</script>
<script>
    const baseUrl = "{{ route('admin.getPurchaseHistoryView', ['id' => 'ID_PLACEHOLDER']) }}";
</script>
@endpush