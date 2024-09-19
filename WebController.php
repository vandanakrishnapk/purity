<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Iluminate\Support\Facades\File;

class WebController extends Controller
{
    public function getContributions(Request $request){

        $jobs = DB::table('tbl_members')->get();
        return response()->json(['data'=> $jobs]);

    }

    // EDIT THE JOB | GET DETAILS TO POPULATE IN MODAL
    public function viewContributions(Request $request){
        $contrDetails = DB::table('tbl_members')->find($request->id);
        return response()->json($contrDetails);
    }
}