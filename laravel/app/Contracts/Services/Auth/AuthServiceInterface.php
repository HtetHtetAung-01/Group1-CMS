<?php

namespace App\Contracts\Services\Auth;

use Illuminate\Http\Request;

/**
 * Interface for user service
 */
interface AuthServiceInterface
{
    /**
     * get the email
     * get the password
     * @param $request
     * @return $route
     */
    public function saveUserCustomLogin($request);

    /**
     * @return $route
     */
    public function logout();

    /**
     * get the email
     * get the password
     * @param $request
     * @return $route
     */
    public function savesubmitForgetPasswordForm($request);

    /**
     * get the email
     * get the password
     * @param $request
     * @return $route
     */
    public function savesubmitResetPasswordForm($request);

}