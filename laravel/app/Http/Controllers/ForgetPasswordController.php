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
    public function submitResetPasswordForm(ForgetPasswordFormRequest $request)
    {
        return $this->authInterface->savesubmitResetPasswordForm($request);
    }
}
