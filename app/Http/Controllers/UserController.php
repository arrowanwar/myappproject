<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Inertia\Inertia;
use App\Mail\OTPMail;
use App\Helper\JWTTocken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    function HomePage()
    {
        return Inertia::render('HomePage');
    }
    function LoginPage()
    {
        return Inertia::render('LoginPage');
    }
    
    function RegistrationPage()
    {
        return Inertia::render('RegistrationPage');
    }
    function ResetPasswordPage()
    {
        return Inertia::render('ResetPasswordPage');
    }
    function SendOtpPage()
    {
        return Inertia::render('SendOtpPage');
    }
    function VerifyOtpPage()
    {
        return Inertia::render('VerifyOtpPage');
    }


    function UserRegistration(Request $request)
    {
        try {
            $email = $request->input('email');
            $name = $request->input('name');
            $mobile = $request->input('mobile');
            $password = $request->input('password');
            User::create([
                "email" => $email,
                "name" => $name,
                "mobile" => $mobile,
                "password" => $password,
            ]);
            $data =[
                'message'=>'Registration Successful',
                'status'=>true, 
                'error'=>''
            ];
            return redirect()->route('RegistrationPage')->with($data);

            // return response()->json([
            //     'status' => 'success',
            //     'message' => 'User Registration successfully'
            // ], );
        } 
        catch (Exception $e) {
            // return response()->json([
            //     'status' => 'failled',
            //     'message' => $e->getMessage(),
            // ], );

            $data =[
                'message'=>'Registration Failed',
                'status'=>false, 
                'error'=>$e->getMessage()
            ];
            return redirect()->route('RegistrationPage')->with($data);
        }

    }
    /*
    JWT token wise UserLogin Code
    =============================
    
    function UserLogIn(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $count = User::where('email', '=', $request->input('email'))
            ->where('password', '=', $request->input('password'))->select('id')->first();
        if ($count !== null) {
            $token = JWTTocken::CreateToken($request->input('email'), $count->id);
            return response()->json([
                'status' => 'success',
                'message' => "Login success",
                'token' => $token,
            ], )->cookie('token', $token, time() + 60 * 24 * 30);
        } else {
            return response()->json([
                'status' => 'failled',
                'message' => 'unauthorized',
            ], );
        }
    }
    */
    /*
    Session wise UserLogin Code
    =============================
    */
    function UserLogIn(Request $request)
    {
   
        $count = User::where('email', '=', $request->input('email'))
            ->where('password', '=', $request->input('password'))->select('id')->first();
        if ($count !== null) {
            $email = $request->input('email');
            $user_id = $count->id;
            $request->session()->put('email', $email);
            $request->session()->put('user_id', $user_id);
            $data =[
                'message'=>'Login Successful',
                'status'=>true, 
                'error'=>''
            ];
            return redirect()->route('DashbooardPage')->with($data);
        } else {
            $data =[
                'message'=>'Login Fail',
                'status'=>false
            ];
            return redirect()->route('LoginPage')->with($data);
        }
    }
    function LogOut()
    {
        return Redirect('/')->cookie('token', '', -1);
    }
    function SendOtpCode(Request $request)
    {

        $email = $request->input('email');
        $otp = rand(1000, 9999);
        $count = User::where('email', '=', $email)->count();
        if ($count == 1) {
            Mail::to($email)->send(new OTPMail($otp));
            User::where('email', '=', $email)->update(['otp' => $otp]);
            return response()->json([
                'status' => 'success',
                'message' => "4 digit {$otp} code send",
            ], );
        } else {
            return response()->json([
                'status' => 'failled',
                'message' => 'unauthorized',
            ], );
        }
    }
    function VerifyOTP(Request $request)
    {
        // dd($request);
        $email = $request->input('email');
        $otp = $request->input('otp');
        $count = User::where('email', '=', $email)
            ->where('otp', '=', $otp)->count();
        if ($count == 1) {
            User::where('email', '=', $email)->update(['otp' => '0']);
            $token = JWTTocken::CreateTokenForSettingPassword($request->input('email'));
            // return response()->json([$token]);
            return response()->json([
                'status' => 'success',
                'message' => "Login success",
                'token' => $token
            ], )->cookie('token', $token, 60 * 24 * 30);
        } else {
            return response()->json([
                'status' => 'failled',
                'message' => 'unauthorized',
            ], );
        }
    }
    function ResetPassword(Request $request)
    {
        try {

            $email = $request->header('email');

            $password = $request->input('password');
            User::where('email', '=', $email)->update(['password' => $password]);
            return response()->json([
                'status' => 'success',
                'message' => 'Request Successful',
                'email' => $email,
            ], );
        } catch (Exception $e) {
            return response()->json([
                'status' => 'fail',
                'message' => 'Something Went Woring',
            ], );
        }
    }
    function UserProfile(Request $request)
    {
        $email = $request->header('email');
        $user = User::where('email', '=', $email)->first();
        return response()->json([
            'status' => 'success',
            'message' => 'Request Successful',
            'data' => $user,
        ], );
    }
    function UpdateProfile(Request $request)
    {
        try {
            $email = $request->header('email');
            $name = $request->input('name');
            $mobile = $request->input('mobile');
            $password = $request->input('password');

            User::where('email', '=', $email)->update([
                "name" => $name,
                "mobile" => $mobile,
                "password" => $password,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Request Successful',
                'email' => $email
            ], );
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failled',
                'message' => 'Shomething Went Wrong',
            ], );
        }
    }


}
