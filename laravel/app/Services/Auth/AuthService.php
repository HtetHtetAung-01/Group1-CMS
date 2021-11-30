<?php

namespace App\Services\Auth;

use App\Contracts\Dao\PasswordReset\PasswordResetDaoInterface;
use App\Contracts\Dao\User\UserDaoInterface;
use App\Contracts\Services\Auth\AuthServiceInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthService implements AuthServiceInterface
{

    private $userDao;
    private $passwordResetDao;

    /**
     * AuthServices constructor
     * @param UserDao $userDao
     */
    public function __construct(
        UserDaoInterface $userDaoInterface,
        PasswordResetDaoInterface $passwordResetDaoInterface
    ) {
        $this->userDao = $userDaoInterface;
        $this->passwordResetDao = $passwordResetDaoInterface;
    }

    /**
     * get the email
     * get the password
     * @param $request
     * @return $route
     */
    public function saveUserCustomLogin($request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            switch (Auth::user()->role_id) {
                case 1:
                    return redirect()->route('student.dashboard', ['id' => Auth::user()->id]);
                    break;
                case 2:
                    return redirect()->route('teacher.dashboard', ['id' => Auth::user()->id]);
                    break;
                case 3:
                    return redirect()->route('admin-home', ['id' => Auth::user()->id]);
                    break;
            }
        } else {
            $message = "";
            $checkUser = $this->userDao->getUserByEmail($request->ema);;
            if ($checkUser) {
                $checkPassword = Hash::check($request->password, $checkUser->password);
                if (!$checkPassword) {
                    $message .= "Incorrect Password";
                }
            } else {
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
        $token = Str::random(64);
        $request->token = $token;

        $this->passwordResetDao->insertPasswordReset($request);

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
        $updatePassword = $this->passwordResetDao
            ->getPasswordResetByEmailAndToken(
                $request->email,
                $request->token
            );

        if (!$updatePassword) {
            return back()->withInput()->with('error', 'Invalid token!');
        }

        $this->userDao->updateUserPasswordByEmail($request->email, $request->password);
        $this->passwordResetDao->deletePasswordResetbyEmail($request->email);

        return redirect('/')->with('message', 'Your password has been changed!');
    }
}
