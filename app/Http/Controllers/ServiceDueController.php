<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon; 
use Illuminate\Http\Request; 
use App\Models\Installation;
use App\Models\Individual; 
use App\Models\User;

class ServiceDueController extends Controller
{
    
    public function getServiceDuePage()
    {
        return view('admin.servicedue');
    } 

    //get reminder 

    public function getServiceReminder()
    { 
      
        $insDetails = DB::table('individuals')
            ->join('products', 'individuals.product_id', '=', 'products.product_id')
            ->join('installations', 'installations.customer_id', '=', 'individuals.individual_id')
            ->select('individuals.p_name', 'products.product_name','individuals.customerId', 'installations.created_at as installdate', 'installations.mainService')
            ->whereIn('individuals.status', ['Completed', 'Assigned'])
            ->get();
        
        // Process each service to calculate the reminder date and days left
        $services = $insDetails->map(function ($service) {
            $installationDate = Carbon::parse($service->installdate);
            $reminderDate = Carbon::parse($service->mainService);
            $today = Carbon::now();
         
            // Calculate the number of days left until the reminder date
            $daysLeft = $today->diffInDays($reminderDate, false);
                      // Ensure daysLeft is non-negative
            $daysLeft = max($daysLeft, 0);
          
            return [
                'customer_id' => $service->customerId,
                'product_name' => $service->product_name,
                'installation_date' => $installationDate->format('d-m-Y'),
                'reminder_date' => $reminderDate->format('d-m-Y'),
                'days_left' => $daysLeft,
                
            ];
        });
      
        // Sort services by days_left in ascending order
        $sortedServices = $services->sortBy('days_left');
    
        // Extract the total number of records before any filtering
        $totalRecords = $insDetails->count();
    
        // Extract the number of records after applying filters
        $filteredRecords = $sortedServices->count(); 
    
        // Handle DataTables' draw parameter
        $draw = request()->get('draw', 1);
    
        return response()->json([
            'draw' => $draw,
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data' => $sortedServices->values()->all(), // Ensure reindexing and convert to array
        ]);
    }
    
    
  
  public function getServiceReminderTable()
  {    $insDetails = DB::table('installations')
    ->join('individuals', 'installations.customer_id', '=', 'individuals.individual_id')
    ->join('products', 'individuals.product_id', '=', 'products.product_id')
    ->join('users', 'individuals.assigned_to', '=', 'users.id')
    ->select('individuals.p_name', 'users.name', 'installations.mainService', 'individuals.individual_id', 'installations.customer_id', 'installations.installId', 'products.product_name', 'installations.created_at as installdate')
    ->get();

// Process each service to calculate the reminder date and days left
$services = $insDetails->map(function ($service) {
    $installationDate = Carbon::parse($service->installdate);
    $reminderDate = Carbon::parse($service->mainService);
    $today = Carbon::now();

    // Calculate the number of days left until the reminder date
    $daysLeft = $today->diffInDays($reminderDate, false);

    // Ensure daysLeft is non-negative
    $daysLeft = max($daysLeft, 0);

    // Format daysLeft as an integer
    $formattedDaysLeft = intval($daysLeft);

    return [
        'client_name' => $service->p_name,
        'product_name' => $service->product_name,
        'installation_date' => $installationDate->format('d-m-Y'),
        'reminder_date' => $reminderDate->format('d-m-Y'),
        'days_left' => $formattedDaysLeft,
        'installId' => $service->installId,
        'customer_id' => $service->customer_id,
        'staff' => $service->name,
    ];
});

// Sort services by days_left in ascending order
$sortedServices = $services->sortBy('days_left');

// Extract the total number of records before any filtering
$totalRecords = $services->count();

// Extract the number of records after applying filters
$filteredRecords = $sortedServices->count(); 

// Handle DataTables' draw parameter
$draw = request()->get('draw', 1);

return response()->json([
    'draw' => $draw,
    'recordsTotal' => $totalRecords,
    'recordsFiltered' => $filteredRecords,
    'data' => $sortedServices->values(), // Ensure reindexing
]);
}   


  public function getChangeStaffView($id)
  { 
 
    $install = Installation::find($id); 

    $users = User::where('role','=',1)->get();
    return response()->json([
        'installId' =>$install->installId,
        'currentStaff' =>$install->staff_id,
        'users' =>$users,
    ]);
  }


   public function updateStaff(Request $request,$installId)
   {
    $request->validate([
        'assigned_to' => 'required|exists:users,id',
        'customer_id' => 'required' // Validate customer ID if needed
    ]);

   // You may need to pass service_id too
    $customerId = $request->input('customer_id');

    // Find and update the Service model
    $install = Installation::find($installId); 
   
    if (!$install) {
        return response()->json(['status' => 0, 'message' => 'Service not found'], 404);
    }
    $install->staff_id = $request->input('assigned_to');
    $install->save();

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

   public function getNextService($id)
   {
    $install = Installation::find($id);
             
        return response()->json([
            'installId' => $install->installId,
            'currentMainService' => $install->mainService,// Adjust based on your relationship
            
        ]);
   } 

   public function updateMainService(Request $request,$id)
   {
    $request->validate([
         
        'mainService' => 'required', // Assuming 'users' is the table for staff
    ]);

    // Find the service by ID
    $service = Installation::find($id);

    // Update the assigned staff

    
    $service->mainService = $request->input('mainService'); // Adjust field names as needed
    
    $service->save(); // Save changes to the database

    // Return a success response
    return response()->json(['status' => 1, 'message' => 'Next Main Service updated successfully']);


   }
 
}
