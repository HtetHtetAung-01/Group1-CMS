<?php

namespace App\Contracts\Dao\PasswordReset;

interface PasswordResetDaoInterface
{
    public function insertPasswordReset($record);
    public function getPasswordResetByEmailAndToken($email, $token);
    public function deletePasswordResetbyEmail($email);
}