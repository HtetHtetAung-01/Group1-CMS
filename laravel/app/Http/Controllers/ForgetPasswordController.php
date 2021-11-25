<?php


namespace App\Http\Controllers;

use App\Contracts\Services\Auth\AuthServiceInterface;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;


class ForgetPasswordController extends Controller
{
    /**
     * Auth AuthInterface
     */
    private $authInterface;


    /**
     * Create a new controller instance.
     * @param AuthServiceInterface $authServiceInterface
     * @return void
     */
    public function __construct(AuthServiceInterface $authServiceInterface)
    {
        $this->authInterface = $authServiceInterface;
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function showForgetPasswordForm()
    {
        return view('forgetpassword.forgetPassword');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function submitForgetPasswordForm(Request $request)
    {
        return $this->authInterface->savesubmitForgetPasswordForm($request);
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function showResetPasswordForm($token)
    {
        return view('forgetpassword.forgetPasswordLink', ['token' => $token]);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function submitResetPasswordForm(Request $request)
    {
        return $this->authInterface->savesubmitResetPasswordForm($request);
    }
}
