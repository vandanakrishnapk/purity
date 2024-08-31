<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str; 
use Illuminate\Support\Facades\DB;
use Carbon\Carbon; 
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class LoginController extends Controller
{
public function view_login()
{
    return view('admin.login');
} 
public function doLogin(Request $request)
{
    
    // Validate the request
    $validator = Validator::make($request->all(), [
        'email' => 'required|email',
        'password' => 'required',
    ],[
        'email.required' =>'Email field is required',
        'email.email' =>'should be an email id',
        'password.required' =>'password field is required',
    ]);

    // Check if the validation fails
    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'errors' => $validator->errors(),
        ], 422);
    }

    $credentials = $request->only(['email', 'password']);

    if (Auth::attempt($credentials)) {
        $user = Auth::user();
        $request->session()->regenerate();

        if ($user->role === 0) {
            return response()->json([
                'success' => true,
               'redirect_url' => url('admin/index'),
            ]);
        }
        if ($user->role === 1) {
            return response()->json([
                'success' => true,
               'redirect_url' => url('user/userHome'),
            ]);
        } else {
            Auth::logout();
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized role.'
            ], 403);
        }
    }

    return response()->json([
        'success' => false,
        'message' => 'Invalid email or password'
    ], 401);
}

public function logout()
{
    Auth::logout();
    return redirect()->route('login');
}
public function forgot_pwd()
{
    return view('admin.forgot_pwd');
}  
public function send_mail_reset()
{
return view('email.reset_password');
}
public function submitForgetPasswordForm(Request $request)
{
    $request->validate([
        'email' => 'required|email',
    ]);

    $token = Str::random(64);

    DB::table('password_reset_tokens')->insert([
        'email' => $request->email, 
        'token' => $token, 
        'created_at' => Carbon::now()
    ]);

    Mail::send('email.reset_password', ['token' => $token], function($message) use($request) {
        $message->to($request->email);
        $message->subject('Reset Password');
    });

    return back()->with('message', 'We have sent an email with the password reset link!');
}

public function change_password_form($token)
{
    return view('email.change_password_form',['token'=>$token]);
}



 /**
  * Write code on Method
  *
  * @return response()
  */
  public function submitResetPasswordForm(Request $request)
  {
   
    $validator = Validator::make($request->all(), [
        'email' => 'required|email',
        'password' => 'required|string|min:8',
        'password_confirmation' => 'required|same:password'
    ], [
        'email.required' => 'Email ID is required',
        'email.email' => 'Please enter a valid email address',
        'password.required' => 'Password is required',
        'password.min' => 'Password must be at least 8 characters',
        'password_confirmation.required' => 'Confirm password is required',
        'password_confirmation.same' => 'The confirm password and password must match',
    ]);
   

      if ($validator->fails()) {
          return back()->withErrors($validator)->withInput();
      }
      $email = $request->input('email');
      $token = $request->input('token');
    
      $updatePassword = DB::table('password_reset_tokens')
          ->where([
              'email' => $email,
              'token' => $token
          ])->first();
       
      if (!$updatePassword) {
          return back()->withInput()->with('error', 'Invalid token!');
      }
  
      $user = User::where('email', $request->email)
          ->update(['password' => bcrypt($request->password)]);
  
      DB::table('password_reset_tokens')->where(['email' => $request->email])->delete();
  
      return redirect()->route('login')->with('message', 'Password has been changed!');
  } 
}
