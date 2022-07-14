<?php
/**
 *doctorweb
 *ASUS
 *3/15/2022
 *11:27 PM
 *SRILANKA-AXCITO
 */

namespace App\Service;

use App\ServiceInterface\AdminUserServiceInterface;
use Illuminate\Support\Facades\Auth;

class AdminUserService
{
    protected AdminUserServiceInterface $adminUserServiceInterface;

    public function __construct(AdminUserServiceInterface $adminUserServiceInterface)
    {
        $this->adminUserServiceInterface = $adminUserServiceInterface;
    }

    public function register($request)
    {
        $inputData = [
            'email' => $request['email'],
            'password' => bcrypt($request['password'])
        ];
        return $this->adminUserServiceInterface->register($inputData);
    }

    public function login($data)
    {
        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
            $user = $this->adminUserServiceInterface->loginUser($data['email']);
            $token = $user->createToken('myapptoken')->plainTextToken;
            return [
                'status' => true,
                'message' => 'Successfully logged in',
                'data' => [
                    'token' => $token,
                ],
            ];
        } else {
            return [
                'status' => false,
                'message' => 'Login failed',
                'data' => null
            ];
        }

    }

    public function passwordUpdate($data)
    {
        $newPassword = [
            'email' => $data['email'],
            'new_password' => bcrypt($data['new_password']),
        ];
        return $this->adminUserServiceInterface->passwordUpdate($newPassword);


    }

    public function logout($request)
    {
        return $this->adminUserServiceInterface->logout($request);
    }
}
