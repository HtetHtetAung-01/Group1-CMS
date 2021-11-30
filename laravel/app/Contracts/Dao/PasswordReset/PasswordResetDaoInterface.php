<?php

namespace App\Contracts\Dao\PasswordReset;

interface PasswordResetDaoInterface
{
    /**
     * To insert password reset token record
     * @param Request $record
     */
    public function insertPasswordReset($record);

    /**
     * To get password reset record by email and token
     * @param string $email user's email
     * @param string $token password reset token
     * @return Object
     */
    public function getPasswordResetByEmailAndToken($email, $token);

    /**
     * To delete password reset token record by email
     * @param string $email user's email
     */
    public function deletePasswordResetbyEmail($email);
}
