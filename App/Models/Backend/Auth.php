<?php
namespace App\Models\Backend;

use DB;

class Auth
{
    public function login($usermail, $userpass)
    {
        $user = DB::table('users')->where('usermail', '=', $usermail)->getRow();
        //dd(DB::lastQuery(), true);

        if ($user) {
            if (password_verify($userpass, $user->userpass))
                return $user;
            else
                return false;
        } else {
            return false;
        }

    }
}
