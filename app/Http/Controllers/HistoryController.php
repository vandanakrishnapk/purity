<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Individual;
use Carbon\Carbon;
use App\Models\Part;
class HistoryController extends Controller
{
    public function getPurchaseHistoryView($id)
    {
        // Retrieve the purchase data, including joins
        $purchase = DB::table('individuals')
            ->join('products', 'individuals.product_id', '=', 'products.product_id')
            ->join('categories', 'categories.category_id', '=', 'individuals.category_id')
            ->join('subcategories', 'subcategories.subcat_id', '=', 'individuals.subcat_id')
            ->leftJoin('installations', 'installations.customer_id', '=', 'individuals.individual_id')
            ->leftJoin('services', 'services.customer_id', '=', 'individuals.individual_id')
            ->leftJoin('users', 'installations.staff_id', '=', 'users.id')
            ->select('individuals.*', 'products.*', 'categories.*', 'subcategories.*', 'installations.*', 'services.*', 'users.name', 'installations.created_at as installation_date', 'installations.nextService as first_service', 'services.nextService as next_service', 'services.created_at as last_service')
            ->where('individuals.individual_id', '=', $id)
            ->first();
    
        if (!$purchase) {
            return view('admin.history')->withErrors('Purchase details not found');
        }
    
        if ($purchase->status === "assigned") {
            $purchase = DB::table('individuals')
                ->join('products', 'individuals.product_id', '=', 'products.product_id')
                ->join('categories', 'categories.category_id', '=', 'individuals.category_id')
                ->join('subcategories', 'subcategories.subcat_id', '=', 'individuals.subcat_id')
                ->where('individual_id', '=', $id)
                ->first();
    
            return view('admin.history', ['purchase' => $purchase]);
        }
    
        if ($purchase->status === "completed") {
            $formattedInstallationDate = Carbon::parse($purchase->installation_date)->format('d-m-Y h:i A');
            $formattedFirstServiceDate = Carbon::parse($purchase->first_service)->format('d-m-Y');
    
            $services = DB::table('services')
                ->where('customer_id', $id)
                ->get()
                ->map(function ($service) {
                    // Decode the JSON string for parts changed
                    $partsChangedIds = json_decode($service->partsChanged, true);
                   
                    if (json_last_error() !== JSON_ERROR_NONE) {
                        echo 'JSON decode error: ' . json_last_error_msg();
                        $partsChangedIds = []; // Default to an empty array in case of an error
                    }
                    $test = json_decode($partsChangedIds, true);

                    // Assuming $partsChangedIds is now an array
                    if (is_array($test)) {
                     
                        $partsChangedIds = array_map('intval', $test);
                    
                        // Query the database
                        $partsData = DB::table('parts')
                            ->whereIn('parts_id', $test)
                            ->pluck('parts_name', 'parts_id');
                    // Retrieve parts data for this service
                    }
                   
                    return [
                       
                        'next_service' => Carbon::parse($service->nextService)->format('d-m-Y'),
                        'last_service' => Carbon::parse($service->created_at)->format('d-m-Y h:i A'),
                        'amount' => $service->amount,
                        'tos' => $service->tos,
                        'partsData' => $partsData, // Include parts data for this service
                    ];
                });
    
            return view('admin.history', [
                'purchase' => $purchase,
                'installation_date' => $formattedInstallationDate,
                'first_service' => $formattedFirstServiceDate,
                'services' => $services,
            ]);
        }
    
        return view('admin.history')->withErrors('Invalid status for the purchase');
    }
    
}
