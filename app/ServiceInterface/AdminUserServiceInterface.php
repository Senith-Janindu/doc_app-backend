<?php
/**
 *doctorweb
 *ASUS
 *3/15/2022
 *11:28 PM
 *SRILANKA-AXCITO
 */

namespace App\ServiceInterface;

interface AdminUserServiceInterface
{
    public function register($inputData);

    public function passwordUpdate($newPassword);

    /**
     * @param $email
     * @return mixed
     */
    public function loginUser($email): mixed;

    public function logout($request);

}
