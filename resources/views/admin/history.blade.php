@extends('layout.index')
@section('css')

@endsection 
@section('history')
<div class="accordion" id="accordionPanelsStayOpenExample">
    <div class="accordion-item">
      <h1 class="accordion-header p-1">
        <button class="accordion-button bg-secondary text-light fs-3" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
         <strong>Customer Profile</strong> 
        </button>
      </h1>
      <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse">
        <div class="accordion-body">
            <div class="card">
                <div class="card-body fs-4">
                <div class="row">
                  <div class="col-2"></div>
                    <div class="col-4">Customer Name</div>
                   <div class="col-1">:</div>
                    <div class="col-4 text-start"><strong>{{ $purchase->p_name }}</strong></div>
                </div>

                <div class="row mt-1">
                    <div class="col-2"></div>
                      <div class="col-4">Mobile</div>
                     <div class="col-1">:</div>
                      <div class="col-4 text-start"><strong>{{ $purchase->mobile }}</strong></div>
                  </div>

                  <div class="row mt-1">
                    <div class="col-2"></div>
                      <div class="col-4">Address</div>
                     <div class="col-1">:</div>
                      <div class="col-4 text-start"><strong>{{ $purchase->address }}</strong></div>
                  </div>

                  <div class="row mt-1">
                    <div class="col-2"></div>
                      <div class="col-4">Whatsapp</div>
                     <div class="col-1">:</div>
                      <div class="col-4 text-start"><strong>{{ $purchase->whatsapp }}</strong></div>
                  </div>

                  <div class="row mt-1">
                    <div class="col-2"></div>
                      <div class="col-4">Landmark</div>
                     <div class="col-1">:</div>
                      <div class="col-4 text-start"><strong>{{ $purchase->landmark }}</strong></div>
                  </div>
                </div>
              </div>
        </div>
      </div>
    </div>

    <div class="accordion-item">
      <h1 class="accordion-header p-1">
        <button class="accordion-button collapsed bg-secondary text-light fs-3" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
         <strong>Product Info</strong>
        </button>
      </h1>
      <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse">
        <div class="accordion-body">
             
            <div class="card">
                <div class="card-body fs-4">
                    
                    <div class="row mt-1">
                        <div class="col-2"></div>
                          <div class="col-4">Category</div>
                         <div class="col-1">:</div>
                          <div class="col-4 text-start"><strong>{{ $purchase->category_name }}</strong></div>
                      </div>

                      <div class="row mt-1">
                        <div class="col-2"></div>
                          <div class="col-4">Sub Category</div>
                         <div class="col-1">:</div>
                          <div class="col-4 text-start"><strong>{{ $purchase->subcategory_name }}</strong></div>
                      </div>

                      <div class="row mt-1">
                        <div class="col-2"></div>
                          <div class="col-4">Product Name</div>
                         <div class="col-1">:</div>
                          <div class="col-4 text-start"><strong>{{ $purchase->product_name }}</strong></div>
                      </div> 

                      <div class="row mt-1">
                        <div class="col-2"></div>
                          <div class="col-4">Filter Change On</div>
                         <div class="col-1">:</div>
                          <div class="col-4 text-start"><strong>{{ $purchase->filter_change_on }}</strong></div>
                      </div>


                </div>
            </div>
        
        
        </div>
      </div>
    </div>
    @if($purchase->status==="completed")
    <div class="accordion-item">
      <h1 class="accordion-header p-1">
        <button class="accordion-button collapsed bg-secondary text-light fs-3" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
          <strong>Installation Info</strong>
        </button>
      </h1>
      <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse">
        <div class="accordion-body">
            
            <div class="card">
                <div class="card-body fs-4">
                    
                    <div class="row mt-1">
                        <div class="col-2"></div>
                          <div class="col-4">Installation Date</div>
                         <div class="col-1">:</div>
                          <div class="col-4 text-start"><strong>{{ $installation_date }}</strong></div>
                      </div>

                    <div class="row mt-1">
                        <div class="col-2"></div>
                          <div class="col-4">Assigned To</div>
                         <div class="col-1">:</div>
                          <div class="col-4 text-start"><strong>{{ $purchase->name }}</strong></div>
                      </div>

                      <div class="row mt-1">
                        <div class="col-2"></div>
                          <div class="col-4">Raw Water TDS</div>
                         <div class="col-1">:</div>
                          <div class="col-4 text-start"><strong>{{ $purchase->rawWater }}</strong></div>
                      </div>

                      <div class="row mt-1">
                        <div class="col-2"></div>
                          <div class="col-4">Source Of Water</div>
                         <div class="col-1">:</div>
                          <div class="col-4 text-start"><strong>{{ $purchase->sow }}</strong></div>
                      </div> 

                      <div class="row mt-1">
                        <div class="col-2"></div>
                          <div class="col-4">Next Service</div>
                         <div class="col-1">:</div>
                          <div class="col-4 text-start"><strong>{{ $first_service }}</strong></div>
                      </div>                     
                </div>
            </div>
        
        </div>
      </div>
    </div>
    <div class="accordion-item">
      <h1 class="accordion-header p-1">
        <button class="accordion-button collapsed bg-secondary text-light fs-3" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFour" aria-expanded="false" aria-controls="panelsStayOpen-collapseFour">
          <strong>Service Info</strong>
        </button>
      </h1>
      <div id="panelsStayOpen-collapseFour" class="accordion-collapse collapse">
        <div class="accordion-body">
          @foreach($services as $service)
                <div class="card">
                    <div class="card-body fs-4">

                        <div class="row mt-1">
                            <div class="col-2"></div>
                              <div class="col-4">Type of Service</div>
                             <div class="col-1">:</div>
                              <div class="col-4 text-start"><strong>{{ $service['tos'] }}</strong></div>
                          </div>  

                          <div class="row mt-1">
                            <div class="col-2"></div>
                              <div class="col-4">Parts Changed</div>
                             <div class="col-1">:</div>
                           
                             <div class="col-4 text-start m-0">
                            
                              <strong>
                                     <ul>
                                         @foreach($service['partsData'] as $partName)
                                             <li>{{ $partName}}</li>
                                         @endforeach
                                     </ul>
                                    </strong>
                             </div>
                                
                              
                           
                          </div>  

                         <div class="row mt-1">
                            <div class="col-2"></div>
                              <div class="col-4">Last Service</div>
                             <div class="col-1">:</div>
                              <div class="col-4 text-start"><strong>{{ $service['last_service'] }}</strong></div>
                          </div> 


                          <div class="row mt-1">
                            <div class="col-2"></div>
                              <div class="col-4">Next Service</div>
                             <div class="col-1">:</div>
                              <div class="col-4 text-start"><strong>{{ $service['next_service'] }}</strong></div>
                          </div>  


                          <div class="row mt-1">
                            <div class="col-2"></div>
                              <div class="col-4">Amount Paid</div>
                             <div class="col-1">:</div>
                              <div class="col-4 text-start"><strong>{{ $service['amount'] }}</strong></div>
                          </div> 

                         


                    </div>
                </div>
                @endforeach
           

        </div>
      </div>
    </div>
  @endif
  </div>
@endsection 
@push('script')

@endpush