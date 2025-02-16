<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function changePassword($userId, $newPassword)
    {
        $hashedPassword = Hash::make($newPassword);
        DB::statement("CALL NewPassword(?, ?)", [$userId, $hashedPassword]);
    }
}
