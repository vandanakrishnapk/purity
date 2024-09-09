<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Part;
use App\Models\Service;
use App\Models\ServiceHistory;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon; 
use App\Models\User;
use App\Models\Installation;
use App\Models\Individual;
use Illuminate\Support\Facades\Log;
class ServiceController extends Controller
{
    public function getServicePage()
    {

        return view('admin.service');
    } 
    
    public function viewServices(Request $request)
    {
        if ($request->ajax()) {
            // Subquery to get the latest service record for each individual
            $latestServiceSubquery = DB::table('services')
                ->select('customer_id', DB::raw('MAX(created_at) as latest_service_date'))
                ->groupBy('customer_id');
    
            // Fetch the latest service records for all individuals
            $recentServices = DB::table('services')
                ->joinSub($latestServiceSubquery, 'latest_services', function ($join) {
                    $join->on('services.customer_id', '=', 'latest_services.customer_id')
                         ->on('services.created_at', '=', 'latest_services.latest_service_date');
                })
                ->join('individuals', 'services.customer_id', '=', 'individuals.individual_id')
                ->join('installations', 'installations.customer_id', '=', 'services.customer_id')
                ->join('products', 'individuals.product_id', '=', 'products.product_id')
                ->join('users','services.staff_id','=','users.id')
                ->select('services.*', 'services.status as serviceStatus','individuals.p_name', 'individuals.mobile','individuals.remarks', 'products.product_name','installations.created_at as installation_date','users.name')
                ->whereIn('individuals.status', ['Completed','Service_Completed'])
                ->orderBy('services.created_at', 'desc') // Order by services.created_at in descending order
                ->get(); // Fetch all records
           
            return response()->json([
                'draw' => request()->get('draw'),
                'recordsTotal' => $recentServices->count(),
                'recordsFiltered' => $recentServices->count(),
                'data' => $recentServices // Return the data
            ]);
        }
    }
    
    public function details($id) {
        $service = Service::find($id);
    
        if (!$service) {
            return response()->json(['error' => 'Service not found'], 404);
        }
    
        $custId = $service->customer_id; 
    
        // Fetch the data from the database for the specific customer_id
        $history = DB::table('services')
            ->join('individuals', 'services.customer_id', '=', 'individuals.individual_id')
            ->join('installations', 'installations.customer_id', '=', 'services.customer_id')
            ->join('products', 'individuals.product_id', '=', 'products.product_id')
            ->select('services.*', 'individuals.p_name', 'individuals.mobile', 'products.product_name', 'installations.created_at as installation_date')
            ->where('services.customer_id', $custId) // Filter by the specific customer_id
            ->where('individuals.status', 'Service_Completed','Completed')
            ->orderBy('services.created_at', 'desc') // Order by services.created_at in descending order
            ->get()
            ->map(function ($item) {
                // Format the dates as DD-MM-YYYY hh:mm A
                $item->created_at = Carbon::parse($item->created_at)->format('d-m-Y h:i A');
                $item->installation_date = Carbon::parse($item->installation_date)->format('d-m-Y h:i A');
                // Format nextService if it exists
                $item->nextService = isset($item->nextService) ? Carbon::parse($item->nextService)->format('d-m-Y') : 'N/A';
                return $item;
            });
    
        return response()->json(['history' => $history]);
    }
    

public function douserService(Request $request)
{
    // Create a new validator instance
    $validator = Validator::make($request->all(), [
        'tos' => 'required|string',
        'partsChanged' => 'required|array',
        'partsChanged.*' => 'exists:parts,parts_id',
        'nextService' => 'required_if:duration,null|date',
        'amount' => 'nullable|numeric',
        'remarks' => 'nullable|string',
        'customer_id' => 'required|exists:individuals,individual_id',
        'status' =>'required|string',
        'staff_id' => 'required|exists:users,id',
    ], [
        'tos.required' => 'Type of Service is required.',
        'partsChanged.required' => 'Parts changed is required',
        'nextService.required' => 'Next Service is required',
        'status.required' =>'Status is required',
    ]);

    // Check if validation fails
    if ($validator->fails()) {
        // Return validation errors as JSON
        return response()->json([
            'status' => 0,
            'error' => $validator->errors()
        ]);
    }

    // Retrieve validated data
    $validatedData = $validator->validated();

    // Create a new instance of your model and assign values
    $service = new Service();
    $service->tos = $validatedData['tos'];
    $service->partsChanged = json_encode($validatedData['partsChanged']); // Convert array to JSON
    $service->nextService = $validatedData['nextService'];
    $service->amount = $validatedData['amount'];
    $service->status = $validatedData['status'];
    $service->remarks = $validatedData['remarks'];
    $service->customer_id = $validatedData['customer_id'];
    $service->staff_id = $validatedData['staff_id'];  
    $service->save(); 
    $individual = Individual::find($request->input('customer_id'));
    if($service->status == 'Completed' && $individual) 
    { 
        $individual->status = 'Service_Completed'; // Update status as needed
        $individual->save();
    }
    
    // Save the model instance to the database
 


    // Return a success response
    return response()->json([
        'status' => 1,
        'message' => 'Service created successfully!',
    ]);
}


//add new parts by admin 
public function partsViewPage()
{
return view('admin.AddParts');
} 
public function doParts(Request $request)
{
    $validator = Validator::make($request->all(), [
        'parts_name' => 'required',
        
            ], 
            [
                'parts_name.required' => 'Parts name is required.',
               ]);

    // Check if validation fails
    if ($validator->fails()) 
     {
        // Return validation errors as JSON
        return response()->json([
            'status' => 0,
            'error' => $validator->errors()]);
     }

    $data = [
        'parts_name' =>$request->input('parts_name'),
        'created_at' => Carbon::now(),  // Add current timestamp
        'updated_at' => Carbon::now(),

    ]; 
    if (DB::table('parts')->insert($data)) {
        return response()->json([
            'status' => 1,
            'message' => 'parts created successfully!',
        ]);
    } else {
        return response()->json([
            'status' => 2,
            'message' => 'Something went wrong!', 
        ]);
    }  
} 


//user service functions
public function getuserServicePage()
    {

        return view('user.servicebyUser');
    } 
    public function getuserParts()
    {
     $parts = Part::all();
     return response()->json([
        'status' =>1,
        'data' =>$parts,
     ]);
    } 
    public function viewuserServices(Request $request)
    { 
         $staffId = Auth::user()->id;
        if ($request->ajax()) {
        
            $insDetails = DB::table('individuals')
                          ->join('products','individuals.product_id','=','products.product_id')                                        
                          ->select('individuals.*','products.product_name')
                          ->where('individuals.assigned_to','=',$staffId)
                          ->whereIn('individuals.status', ['Completed'])
                          ->get();
            $totalRecords = count($insDetails); // Total records in your data source
            $filteredRecords = count($insDetails); // Number of records after applying filters
       
            return response()->json(['draw' => request()->get('draw'),
                                    'recordsTotal' => $totalRecords,
                                    'recordsFiltered' => $filteredRecords,
                                    'data' => $insDetails]);
        }
        return response()->json(['error' => 'Invalid request'], 400);
    } 
public function getuserFixService(Request $request,$id)
{
    $stId = Auth::user()->id;
    if ($request->ajax()) { 
        $insDetails = DB::table('individuals')
            ->join('products', 'individuals.product_id', '=', 'products.product_id')
            ->join('installations','individuals.individual_id','=','installations.customer_id')
            ->where('individuals.individual_id', $id)
            ->select('individuals.*', 'products.product_name','installations.nextService')
            ->first();

        return response()->json(['insDetails'=>$insDetails,'staff_id'=>$stId]);
    }
} 
public function getPartsData(Request $request)
{
    if ($request->ajax()) {
        $parts = Part::select(['parts_id','parts_name'])->get();
        $totalRecords = count($parts); // Total records in your data source
        $filteredRecords = count($parts); // Number of records after applying filters
    
        return response()->json(['draw' => request()->get('draw'),
                                'recordsTotal' => $totalRecords,
                                 'recordsFiltered' => $filteredRecords,
                                  'data' => $parts]);
    }
    return response()->json(['error' => 'Invalid request'], 400);


} 
public function edit($id)
    {
        $parts = Part::findOrFail($id);
        return response()->json($parts);
    }
    public function update(Request $request, $id)
    {
        try {
            $user = Part::findOrFail($id);
            $user->update($request->all());
            return response()->json(['status' => 1, 'message' => 'Parts updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['status' => 0, 'error' => ['message' => 'Parts update failed']]);
        }
    } 
    public function destroy($id)
    {
        try {
            Part::findOrFail($id)->delete();
            return response()->json(['status' => 1, 'message' => 'Parts deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['status' => 0, 'error' => 'Parts deletion failed']);
        }

 } 
 public function getParts()
    {
     $parts = Part::all();
     return response()->json([
        'status' =>1,
        'data' =>$parts,
     ]);
    }   


   
    public function changeStaff($id)
    {
        $service = Service::find($id); 
        $customer = 
        $users = User::where('role','=',1)->get(); // Get all users
        
        return response()->json([
            'serviceId' => $service->serviceId,
            'currentStaff' => $service->staff_id, // Adjust based on your relationship
            'users' => $users
        ]);
    } 

    public function updateStaff(Request $request,$serviceId)
    {
        $request->validate([
            'assigned_to' => 'required|exists:users,id',
            'customer_id' => 'required' // Validate customer ID if needed
        ]);
    
       // You may need to pass service_id too
        $customerId = $request->input('customer_id');
    
        // Find and update the Service model
        $service = Service::find($serviceId);
        if (!$service) {
            return response()->json(['status' => 0, 'message' => 'Service not found'], 404);
        }
        $service->staff_id = $request->input('assigned_to');
        $service->save();
    
        // Find and update the Individual model
        $individual = Individual::where('individual_id', $customerId)->first();
        if (!$individual) {
            return response()->json(['status' => 0, 'message' => 'Individual not found'], 404);
        }
        $individual->assigned_to = $request->input('assigned_to');
        $individual->status ='Completed';
        $individual->save();
    
        return response()->json(['status' => 1, 'message' => 'Staff updated successfully']);
    }
    

    //change next service view 
    public function changeNextService($id)
    {
        $service = Service::find($id);
             
        return response()->json([
            'serviceId' => $service->serviceId,
            'currentnextService' => $service->nextService, // Adjust based on your relationship
            
        ]);
    } 

    //update next service 

    public function updateNextService(Request $request,$id)
    {
    
        $request->validate([
         
            'nextService' => 'required', // Assuming 'users' is the table for staff
        ]);

        // Find the service by ID
        $service = Service::find($id);

        // Update the assigned staff
    
        
        $service->nextService = $request->input('nextService'); // Adjust field names as needed
        
        $service->save(); // Save changes to the database

        // Return a success response
        return response()->json(['status' => 1, 'message' => 'Next Service updated successfully']);
    
         
    } 


    //service due section 

    public function getServiceDuePage()
    {
        return view('admin.servicedue');
    } 

    //get reminder 

    public function getServiceReminder()
    {
        $insDetails = DB::table('individuals')
        ->join('products', 'individuals.product_id', '=', 'products.product_id')
        ->join('installations','installations.customer_id','=','individuals.individual_id')
        ->select('individuals.*', 'products.product_name','installations.created_at as installdate')
        ->whereIn('individuals.status', ['completed', 'assigned'])
        ->get();
    
    // Process each service to calculate the reminder date and check if it falls in the reminder window
    $services = $insDetails->map(function ($service) {
        // Calculate the date 1 year after the installation date
        $installationDate = Carbon::parse($service->installdate);
        $reminderDate = $installationDate->addYear();
        
        // Calculate the window for the reminder (1 week before the reminder date)
        $oneWeekBeforeReminder = $reminderDate->copy()->subWeek();
        
        // Check if the current date is within the reminder window
        $today = Carbon::now();
        $isDue = $today->greaterThanOrEqualTo($oneWeekBeforeReminder) && $today->lessThanOrEqualTo($reminderDate);

        return [
           
            'product_name' => $service->product_name,
            'installation_date' => $service->installdate,
            'reminder_date' => $reminderDate->format('Y-m-d'),
            'is_due' => $isDue,
        ];
    });

    // Return the reminders as JSON
    return response()->json($services);  
  }  

  
  public function getServiceReminderTable()
  {
      $insDetails = DB::table('installations')
          ->join('individuals', 'installations.customer_id', '=', 'individuals.individual_id')
          ->join('products', 'individuals.product_id', '=', 'products.product_id')
          ->select('individuals.p_name', 'products.product_name', 'installations.created_at as installdate')
          ->get();
  
      // Process each service to calculate the reminder date and days left
      $services = $insDetails->map(function ($service) {
          $installationDate = Carbon::parse($service->installdate);
          $reminderDate = $installationDate->copy()->addYear();
          $today = Carbon::now();
  
          // Calculate the number of days left until the reminder date
          $daysLeft = $today->diffInDays($reminderDate, false);
  
          // Ensure daysLeft is non-negative
          $daysLeft = max($daysLeft, 0);
  
          // Format daysLeft as an integer and append " days"
          $formattedDaysLeft = intval($daysLeft);
  
          return [
              'client_name' => $service->p_name,
              'product_name' => $service->product_name,
              'installation_date' => $installationDate->format('d-m-Y'),
              'reminder_date' => $reminderDate->format('d-m-Y'),
              'days_left' => $formattedDaysLeft,
          ];
      });
  
      // Extract the total number of records before any filtering
      $totalRecords = $insDetails->count();
  
      // Extract the number of records after applying filters
      $filteredRecords = $services->count();
  
      // Handle DataTables' pagination and draw parameters
      $draw = request()->get('draw', 1);
      // Uncomment these lines if you want to support pagination
      // $start = request()->get('start', 0);
      // $length = request()->get('length', $totalRecords);
      // $paginatedData = $services->slice($start, $length);
  
      // Return the reminders as JSON
      return response()->json([
          'draw' => $draw,
          'recordsTotal' => $totalRecords,
          'recordsFiltered' => $filteredRecords,
          'data' => $services,
      ]);
  }
   
    
}