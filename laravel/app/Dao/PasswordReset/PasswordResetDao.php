<?php

namespace App\Dao\PasswordReset;

use App\Contracts\Dao\PasswordReset\PasswordResetDaoInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PasswordResetDao implements PasswordResetDaoInterface
{
    /**
     * To insert password reset token record
     * @param Request $record
     */
    public function insertPasswordReset($request)
    {
        DB::table('password_resets')
            ->insert([
                'email' => $request->email,
                'token' => $request->token,
                'created_at' => Carbon::now()
            ]);
    }
    
    /**
     * To get password reset record by email and token
     * @param string $email user's email
     * @param string $token password reset token
     * @return Object
     */
    public function getPasswordResetByEmailAndToken($email, $token)
    {
        return DB::table('password_resets')
            ->where(['email' => $email, 'token' => $token])
            ->first();
    }

    /**
     * To delete password reset token record by email
     * @param string $email user's email
     */
    public function deletePasswordResetbyEmail($email)
    {
        DB::table('password_resets')
            ->where(['email' => $email])
            ->delete();
    }
}