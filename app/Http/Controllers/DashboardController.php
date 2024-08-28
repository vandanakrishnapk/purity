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
    $installations = DB::table('installations')
    ->select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as count'))
    ->groupBy(DB::raw('MONTH(created_at)'))
    ->orderBy(DB::raw('MONTH(created_at)'))
    ->get();

// Format the data for the chart
$data = [
    'labels' => $installations->pluck('month')->map(function($month) {
        return \DateTime::createFromFormat('!m', $month)->format('F');
    }),
    'counts' => $installations->pluck('count'),
];

// Return the data as JSON
return response()->json($data);
} 
public function getServicesCount()
{
    // Fetch count of services from the 'services' table
    $serviceCount = DB::table('services')->count();

    // Return the count as JSON
    return response()->json(['count' => $serviceCount]);
}

}



