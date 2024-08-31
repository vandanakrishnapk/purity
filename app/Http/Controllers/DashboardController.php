<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class DashboardController extends Controller
{
public function getCustomerCount()
{
    $totalCount = DB::table('individuals')->count();
    return response()->json(['total' => $totalCount]);
}   
public function getInstallationCounts()
{
    $totalCount = DB::table('installations')->count();
    return response()->json(['total' => $totalCount]);
// Return the data as JSON

} 
public function getServicesCount()
{
    // Fetch count of services from the 'services' table
    $serviceCount = DB::table('services')->count();

    // Return the count as JSON
    return response()->json(['count' => $serviceCount]);
}

}



