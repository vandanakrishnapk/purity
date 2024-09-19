<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserController extends Controller
{
    //to get users id to individuals table
    public function getUsers()
    {
        $users = User::where('role','=','1')->get();
        return response()->json($users);
    } 
    //view user blade
    public function viewUser()
    {
        return view('admin.view_user');
    }  

    //view user profile 
    public function userProfile(Request $request,$id)
    {
        $user = User::where('role', 1)->find($id);

    // Check if the user exists
    if (!$user) {
        return response()->json(['error' => 'Staff not found'], 404);
    }

    // Return the user data as JSON
    return response()->json($user);
    }
    //creates users in to users table
    public function doAddUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:2',
            'email' => 'required|email',
            'mobile' => 'required|digits:10',
            'password' => 'required|min:8',
            'designation' => 'required|string',
                ], 
                [
                    'name.required' => 'Name is required.',
                    'name.min' => 'Name must be at least 2 characters.',
                    'email.required' => 'Email is required.',
                    'email.email' => 'Invalid email format.',
                    'mobile.required' => 'Mobile number is required.',
                    'mobile.digits' => 'Mobile number must be 10 digits.',
                    'password.required' => 'Password is required.',
                    'password.min' => 'Password must be at least 8 characters.',
                    'designation.required' => 'Designation is required.',
                ]);
    
        // Check if validation fails
        if ($validator->fails()) {
            // Return validation errors as JSON
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()]);
        }
    
        $data = [
            'name' =>$request->input('name'),
            'email' =>$request->input('email'),
            'mobile' =>$request->input('mobile'),
            'designation' =>$request->input('designation'),
            'password' =>bcrypt($request->input('password')),
            'role' => 1,
            'created_at' => Carbon::now(),  // Add current timestamp
            'updated_at' => Carbon::now(),
    
        ]; 
        if (DB::table('users')->insert($data)) {
            return response()->json([
                'status' => 1,
                'message' => 'Staff created successfully!',
            ]);
        } else {
            return response()->json([
                'status' => 2,
                'message' => 'Something went wrong!', 
            ]);
        }
    } 
 
    public function getUserData(Request $request)
{
    if ($request->ajax()) {
        // Retrieve parameters from DataTables
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');
        $searchValue = $request->get('search')['value'];
        $orderColumn = $request->get('order')[0]['column'];
        $orderDir = $request->get('order')[0]['dir'];

        // Define column names to use for sorting
        $columns = ['id', 'name', 'email', 'mobile', 'designation'];

        // Build query with filters and sorting
        $query = User::select(['id', 'name', 'email', 'mobile', 'designation'])
                     ->where('role', '=', '1');

        // Apply search filter
        if (!empty($searchValue)) {
            $query->where(function($q) use ($searchValue) {
                $q->where('name', 'like', "%{$searchValue}%")
                  ->orWhere('email', 'like', "%{$searchValue}%")
                  ->orWhere('mobile', 'like', "%{$searchValue}%")
                  ->orWhere('designation', 'like', "%{$searchValue}%");
            });
        }

        // Apply sorting
        if (isset($columns[$orderColumn])) {
            $query->orderBy($columns[$orderColumn], $orderDir);
        }

        // Total records without filtering
        $totalRecords = User::where('role', '=', '1')->count();

        // Paginate the results
        $users = $query->offset($start)->limit($length)->get();

        // Filtered records count
        $filteredRecords = $query->count();

        return response()->json([
            'draw' => $draw,
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data' => $users
        ]);
    }
    return response()->json(['error' => 'Invalid request'], 400);
}


    //user home 

    public function userHome()
    {
        return view('user.home');
    } 

    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->update($request->all());
            return response()->json(['status' => 1, 'message' => 'Staff updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['status' => 0, 'error' => ['message' => 'Staff update failed']]);
        }
    }
    public function destroy($id)
    {
        try {
            User::findOrFail($id)->delete();
            return response()->json(['status' => 1, 'message' => 'Staff deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['status' => 0, 'error' => 'Staff deletion failed']);
        }
    }
    
}
