<?php
namespace App\Models\Backend;

use DB;

class Admin
{

    /**
     * Şifre kontrolü
     *
     * @param int $userId
     * @param string $current
     * @return boolean
     */
    public function confirmCurrent($userId, $current)
    {
        $user = DB::table('users')->where('userId', '=', $userId)->getRow();

        if (password_verify($current, $user->userpass))
            return true;
        else
            return false;
    }

    /**
     * Yönetici şifresini güncelleme
     *
     * @param int $userId
     * @param array $password
     * @return boolean
     */
    public function update($userId, $password)
    {
        return DB::table('users')->where('userId', '=', $userId)->update($password);
    }
}
