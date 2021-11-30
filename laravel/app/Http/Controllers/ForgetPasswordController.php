<?php


namespace App\Http\Controllers;

use App\Contracts\Services\Auth\AuthServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\ForgetPasswordFormRequest;
use Illuminate\Http\Request;

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
     * show forget password form
     *
     * @return view forgetpassword.forgetPassword
     */
    public function showForgetPasswordForm()
    {
        return view('forgetpassword.forgetPassword');
    }

    /**
     * submit forget password form
     * @param Request $request
     * @return back()
     */
    public function submitForgetPasswordForm(Request $request)
    {
        return $this->authInterface->savesubmitForgetPasswordForm($request);
    }

    /**
     * show reset password form
     * @param $token
     * @return view forgetpassword.forgetPasswordLink
     */
    public function showResetPasswordForm($token)
    {
        return view('forgetpassword.forgetPasswordLink', ['token' => $token]);
    }

    /**
     * submit reset password form
     * @param Request $request
     * @return response()
     */
    public function submitResetPasswordForm(ForgetPasswordFormRequest $request)
    {
        return $this->authInterface->savesubmitResetPasswordForm($request);
    }
}
