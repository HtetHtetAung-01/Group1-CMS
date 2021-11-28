<?php

namespace App\Services\Auth;

use Illuminate\Support\Facades\DB;
use App\Dao\User\UserDao;
use App\Contracts\Services\Auth\AuthServiceInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;


class AuthService implements AuthServiceInterface
{

    /**
     * AuthServices constructor
     * @param UserDao $authDao
     */
    public function __construct()
    {
        
    }

    /**
     * get the email
     * get the password
     * @param $request
     * @return $route
     */
    public function saveUserCustomLogin($request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            if (Auth::user()->role_id == 1) {
                return redirect('/student/' . Auth::user()->id . '/dashboard');
            }
            elseif (Auth::user()->role_id == 2) {
                return redirect('/teacher/' . Auth::user()->id . '/dashboard');
            }
            else {
                return redirect('/admin/' . Auth::user()->id);
            }
        }
        else {
            $message = "";
            $checkUser = User::where('email', $request->email)->first();
            if ($checkUser) {
                $checkPassword = Hash::check($request->password, $checkUser->password);
                if (!$checkPassword) {
                    $message .= "Incorrect Password";
                }
            }
            else {
                $message .= "Your email is not registered in the system";
            }
            return redirect()->back()->with('message', $message);
        }
    }
    /**
     * @return $route
     */
    public function logout()
    {
        Session::flush();
        Auth::logout();

        return Redirect('/');
    }
    /**
     * get the email
     * get the password
     * @param $request
     * @return $route
     */
    public function savesubmitForgetPasswordForm($request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        Mail::send('email.forgetPassword', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        return back()->with('message', 'We have e-mailed your password reset link!');
    }

    /**
     * get the email
     * get the password
     * @param $request
     * @return $route
     */
    public function savesubmitResetPasswordForm($request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);

        $updatePassword = DB::table('password_resets')
            ->where([
            'email' => $request->email,
            'token' => $request->token
        ])
            ->first();

        if (!$updatePassword) {
            return back()->withInput()->with('error', 'Invalid token!');
        }

        $user = User::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);

        DB::table('password_resets')->where(['email' => $request->email])->delete();

        return redirect('/')->with('message', 'Your password has been changed!');
    }


}