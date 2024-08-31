@extends('layout.index')
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
                <table id="installTableAdmin" class="table table-striped dt-responsive nowrap w-100">
                    <thead class="bg-dark text-light">
                        <tr>
                          <th class="text-light">SlNo</th>
                            <th class="text-light">Client Name</th>
                            <th class="text-light">Mobile</th>
                            <th class="text-light">Product</th>                           
                            <th class="text-light">Requested On</th>
                            <th class="text-light">Status</th>
                            <th class="text-light">Remarks</th>
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
    $(document).ready(function() {
        $('#installTableAdmin').DataTable({
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
                    title:'installations',
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
                url: `{{ url('/admin/installations/view/data') }}`,
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
                    data: 'status', name: 'status',
                    render: function(data, type, row) {
        // Determine text color based on the status
        let colorClass;
        if (data === 'Completed') {
            colorClass = 'text-bg-success';
        } else if (data === 'Assigned') {
            colorClass = 'text-bg-primary';
        } else {
            return "null";
        }
        
        // Return the status with the appropriate color
        return `<span class="badge ${colorClass}">${data}</span>`;
    }
                },
              {
                data:'remarks',name:'remarks',
              },
            ],
            columnDefs: [{ visible: false, targets: [] }],
        });
    });
</script>
@endpush