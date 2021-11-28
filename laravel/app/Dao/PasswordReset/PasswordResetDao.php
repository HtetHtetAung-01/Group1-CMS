<?php

namespace App\Dao\PasswordReset;

use App\Contracts\Dao\PasswordReset\PasswordResetDaoInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PasswordResetDao implements PasswordResetDaoInterface
{
    public function insertPasswordReset($request)
    {
        DB::table('password_resets')
            ->insert([
                'email' => $request->email,
                'token' => $request->token,
                'created_at' => Carbon::now()
            ]);
    }
    
    public function getPasswordResetByEmailAndToken($email, $token)
    {
        return DB::table('password_resets')
            ->where(['email' => $email, 'token' => $token])
            ->first();
    }

    public function deletePasswordResetbyEmail($email)
    {
        DB::table('password_resets')
            ->where(['email' => $email])
            ->delete();
    }
}