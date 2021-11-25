<?php

namespace App\Contracts\Dao\Auth;

/**
 * Interface of Data Access Object for user
 */
interface AuthDaoInterface
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