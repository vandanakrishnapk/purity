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

@section('data_table')
<div class="row">  
    <div class="col-12">
        <div class="card">   
            <div class="card-header">
                <caption><h3 class="mt-3 rounded-3">PRODUCTS</h3></caption> 
                </div>  
    <div class="row">
        <div class="col-1"></div>
        <div class="col-lg-10 col-md-10 col-xs-8 col-sm-8">
                                  
                <div class="card-body">
                    
                    <table id="productData" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr class="head-color"> 
                                <th class="text-light">SlNo</th>                                            
                                <th class="text-light">Category</th>
                                <th class="text-light">Sub Category</th>
                                <th class="text-light">Product Name</th>
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
@section('user_modal')
<button type="button" class="btn btn-primary float-end add-user-btn" data-bs-toggle="modal" data-bs-target="#CategoryProductDetailsModal">
<span class="plus-symbol">+</span>
</button>

<div class="modal fade" id="CategoryProductDetailsModal" class="ProductDetail" tabindex="-1" aria-labelledby="CategoryProductDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h1 class="modal-title fs-5 text-light" id="CategoryProductDetailsModalLabel">Add Product</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4" id="CategoryProductDetails">
            <form id="AddProductForm" method="POST">
              @csrf
            <div class="row align-items-start justify-content-start">
                <div class="col-11">
                <label>Category:</label>
                <select id="category-select2" name="category_id" class="form-select">
                @foreach($categories as $cat)
                <option value="{{ $cat->category_id }}">{{ $cat->category_name }}</option>
                @endforeach
              </select><br>
                </div>
                <div class="col-1 text-start mt-3">
                <button type="button" class="btn btn-primary add-user-btn mt-2" data-bs-toggle="modal" data-bs-target="#CategoryDetailsModal">
                <span class="plus-symbol">+</span>
            </button>
                </div>
            </div>
           
            
    <div class="row align-items-start justify-content-start">
        <div class="col-11">
            <label for="subcategory-select">SubCategory:</label>
            <select id="subcategory-select" name="subcategoryId" class="form-select">
                <option value=""></option>
            </select>
        </div>
        <div class="col-1 text-start mt-3">
            <button type="button" class="btn btn-primary add-user-btn mt-2" data-bs-toggle="modal" data-bs-target="#SubCategoryDetailsModal">
                <span class="plus-symbol">+</span>
            </button>
            
        </div>
    </div>
<div class="row align-items-start justify-content-start">
    <div class="col-11">
    <label>Product:</label>
            <input type="text" name="product_name" class="form-control" >
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
<div class="modal fade" id="SubCategoryDetailsModal" tabindex="-1" aria-labelledby="SubCategoryDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h1 class="modal-title fs-5 text-light" id="SubCategoryDetailsModalLabel">Add SubCategory</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4" id="SubCategoryDetails">
            <form id="SubCategoryForm" method="POST">
            @csrf
        
        <label for="SubCategory">category:</label>
        <select id="category1" name="category_id" class="form-control">

        </select><br>
        
        <label for="SubCategory">SubCategory:</label>
        <input type="text" id="SubCategory" name="subcategory_name" class="form-control"><br>
        
        <button type="submit" class="btn btn-primary" style="margin-left:180px">Submit</button>
    </form>
            </div>
        </div>
    </div>
</div> 
<!-- category smodal -->
<div class="modal fade" id="CategoryDetailsModal" tabindex="-1" aria-labelledby="#CategoryDetailsModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h1 class="modal-title fs-5 text-light" id="categoryDetailsModalLabel">Add category</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4" id="categoryDetails">
         <form id="categoryForm">
         @csrf      
        
        <label for="category">category:</label>
        <input type="text" id="category" name="category_name" class="form-control"><br>
        
        <button type="submit" class="btn btn-primary" style="margin-left:180px">Submit</button>
        </form>
            
            </div>
        </div>
    </div>
</div> 


<!--edit product form --> 
<div class="modal fade EditProductDetails" id="EditProductDetailsModal" tabindex="-1" aria-labelledby="EditProductDetailsModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h1 class="modal-title fs-5 text-light" id="EditProductDetailsModal">Edit Product</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4" id="EditProductDetails">
            <form id="EditProductForm" action="{{ route('admin.products.update') }}" method="POST">
              @csrf
            <div class="row align-items-start justify-content-start">
                <div class="col-11">
                <label>Category:</label>
                <select id="category-edit" name="category_id" class="form-select">
                @foreach($categories as $cat)
                <option value="{{ $cat->category_id }}">{{ $cat->category_name }}</option>
                @endforeach
              </select><br>
                </div>
                <div class="col-1 text-start mt-3">
               
                </div>
            </div>
           
            
    <div class="row align-items-start justify-content-start">
        <div class="col-11">
            <label for="subcategory-select">SubCategory:</label>
            <select id="subcategory-edit" name="subcategoryId" class="form-select">
                <option value="">Select Subcategory</option>
                <option value=""></option>
            </select>
        </div>
        <div class="col-1 text-start mt-3">
          
            
        </div>
    </div>
<div class="row align-items-start justify-content-start">
    <div class="col-11">
    <label>Product:</label>
            <input type="text" name="product_name" class="form-control" id="product-edit">
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
        <input type="hidden" name="product_id" id="editProductId">
        <button type="submit" class="btn btn-primary mt-2" style="margin-left:290px">Submit</button>
            </form>
            </div>
        </div>
    </div>
</div> 
<div class="modal fade" id="SubCategoryDetailsModal" tabindex="-1" aria-labelledby="SubCategoryDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h1 class="modal-title fs-5 text-light" id="SubCategoryDetailsModalLabel">Add SubCategory</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4" id="SubCategoryDetails">
            <form id="SubCategoryForm" method="POST">
            @csrf
        
        <label for="SubCategory">category:</label>
        <select id="category1" name="category_id" class="form-control">

        </select><br>
        
        <label for="SubCategory">SubCategory:</label>
        <input type="text" id="SubCategory" name="subcategory_name" class="form-control"><br>
        
        <button type="submit" class="btn btn-primary" style="margin-left:180px">Submit</button>
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
            

                <table class="table table-bordered table-sm">
                
                    <tr>
                        <th>Product Name</th>
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
    var table = $('#productData').DataTable();
    new $.fn.dataTable.FixedHeader(table);
});

    $(document).ready(function() {
    $('#productData').DataTable({
        
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
                title:'Products',
                titleAttr: 'Export to CSV',
                className: 'custombutton',
            }
        ],
        lengthMenu: [
            [10, 25, 50, -1],
            ['10 Products', '25 Products', '50 Products', 'All Products']
        ],
        ajax: {
            url: `{{ url('/admin/getProductData') }}`,
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
            { data: 'category_name' },
            { data: 'subcategory_name' },
            { data: 'product_name' },
            { data: 'remarks'},
            {
                data: null,
                name: 'action',
                orderable: false,
                searchable: false,
                render: function(data, type, row, meta) {
                    return `
                        <div class="dd d-flex">                    
                            <button class="btn btn-warning btn-sm edit-product me-1" data-id="${row.product_id}">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <button class="btn btn-danger btn-sm delete-product" data-id="${row.product_id}" data-proname="${row.product_name}">
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

    $(document).ready(function() {
    $('#category-select2').change(function(){
        $.ajax({
                url: "{{ url('/admin/subcatSelect') }}?category_id=" + $(this).val(),
                method: 'GET',
                success: function(data) {
                    $('#subcategory-select').find('option').remove().end();
                    $('#subcategory-select').html(data.html);
                }
            });      
         });
    });
    $(document).ready(function() {
    $.ajax({
        url: `{{ url('/admin/SubgetCategories') }}`,
        method: 'GET',
        success: function(data) {
            console.log(data); // Log data to ensure it's correctly fetched           
            var categorySelect = $('#category1');        
             data.forEach(function(category) {
                // Create an <option> element with category_name as text and category_id as value
                var option = $('<option></option>')
                    .val(category.category_id) // Set value attribute
                    .text(category.category_name); // Set visible text
                categorySelect.append(option); // Append the option to the select element
            });
               
        },
        error: function(error) {
            console.log("Error fetching categories:", error);
        }
    });


//add subcategory 
$('#SubCategoryForm').on('submit', function(event) {
        event.preventDefault();
        var formData = $(this).serialize();
        // console.log(formData); // Log form data to ensure it's correctly serialized
        
        $.ajax({
            url: `{{ route('admin.doSubcategory') }}`,
            method: 'POST',
            data: formData,
            success: function(response) {
                $('#SubCategoryDetailsModal').modal('hide');
                toastr.success(response.message);
                setTimeout(function() {
                    location.reload();
                }, 2000);
            },
            error: function(error) {
                console.log("Error submitting product:", error);
            }
        });
    });
});  

$('#categoryForm').on('submit', function(event) {
        event.preventDefault();
        var formData = $(this).serialize();
              
        $.ajax({
            url: `{{ route('admin.doAddCategory') }}`,
            method: 'POST',
            data: formData,
            success: function(response) { 
                $('#CategoryDetailsModal').modal('hide');
                toastr.success(response.message);
                setTimeout(function() {
                    location.reload();
                }, 2000);
                
            },
            error: function(error) {
                console.log("Error submitting product:", error);
            }
        });
    });

    $('#AddProductForm').on('submit', function(event) {
    event.preventDefault();
    var formData = $(this).serialize();
              
    $.ajax({
        url: `{{ route('admin.doAddProduct') }}`,
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
                $('#CategoryProductDetailsModal').modal('hide');
                $('#AddProductForm')[0].reset();
                toastr.success(response.message);
                setTimeout(function() {
                    location.reload();
                }, 2000);
            }
        },
        error: function(error) {
            console.log("Error submitting product:", error);
        }
    });
});

    //edit product 
  //id="ProductDetailsModal" class="ProductDetail"
  $(document).ready(function() {
    $("#productData").on("click", ".edit-product", function(e) {
        e.preventDefault();
        var productId = $(this).data('id');
        
        // Reset form and error messages
        $('.EditProductDetails').find('form')[0].reset();
        $('.EditProductDetails').find('span.error_text').text('');
        
        // Show the modal
        $('#EditProductDetailsModal').modal('show');
        
        $.ajax({
            method: "GET",
            headers: {
                Accept: "application/json"
            },
            url: `{{ url('/admin/products/${productId}/edit') }}`,
            data: {
                "_token": "{{ csrf_token() }}",
                id: productId
            },
            dataType: 'json',
            success: function(response) {
                // Populate form fields
                $('#editProductId').val(response.product_id);
                $('#category-edit').val(response.category_id); // Set category
                
                // Manually trigger the category change event to load subcategories
                loadSubcategories(response.category_id, function() {
                    // Ensure subcategory is selected after loading options
                    $('#subcategory-edit').val(response.subcategoryId);
                });

                $('#product-edit').val(response.product_name);
                $('#remarkon').val(response.remarks);
            }
        });
    });

    // Function to load subcategories based on selected category
    function loadSubcategories(categoryId, callback) {
        $.ajax({
            url: "{{ url('/admin/subcatSelect') }}?category_id=" + categoryId,
            method: 'GET',
            success: function(data) {
                $('#subcategory-edit').html(data.html);
                if (callback) {
                    callback(); // Execute the callback function after loading options
                }
            }
        });
    }

    // Handle category change to load new subcategories
    $('#category-edit').change(function() {
        var categoryId = $(this).val();
        loadSubcategories(categoryId);
    });
});

//update product  

$(document).ready(function() {
    $('#EditProductForm').on('submit', function(e) {
        e.preventDefault();
        var form = this;
        let formData = $(this).serializeArray();

        $.ajax({
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('admin.products.update') }}",
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
                    $('#EditProductDetailsModal').modal('hide');
                    $('#EditProductForm')[0].reset();
                    toastr.success(data.message);
                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                }
            }
        });
    });
});









//delete product


$(document).on('click', '.delete-product', function() {
    const Id = $(this).data('id');
    const productName = $(this).data('proname'); // Assuming you have the username data attribute

  
    $('#modalUserName').text(productName);
    $('#modalMessage').text('Are you sure you want to delete this Product?');

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
            url: `{{ url('/admin/products') }}/${Id}`,
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
                 $('#productData').DataTable().ajax.reload();
             
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

@endpush