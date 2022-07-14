<?php
/**
 *doctorweb
 *ASUS
 *3/15/2022
 *11:29 PM
 *SRILANKA-AXCITO
 */

namespace App\Repostiory;

use App\Models\User;
use App\ServiceInterface\AdminUserServiceInterface;

class AdminUserRepository implements AdminUserServiceInterface
{

    public function register($inputData)
    {
        try {
            $user = User::where('email', '=', $inputData['email'])->first();
            if ($user === null) {
                $newUser = new User();
                $newUser->fill($inputData);
                $newUser->save();
                return ['user_id' => $newUser->id,];
            } else {
                return ['user_id' => null];
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function passwordUpdate($newPassword)
    {
        $userEmail = $newPassword['email'];
        $newPassword = $newPassword['new_password'];

        $user = User::where('email', $userEmail)->exists();
        if ($user == true) {
            User::where(['email' => $userEmail])->update(
                ['password' => $newPassword]);
            return 'password updated';
        } else {
            return 'user not found';
        }
    }

    public function loginUser($email): mixed
    {
        return User::where('email', $email)->first();
    }

    public function logout($request)
    {
        try {
            return $request->user()->currentAccessToken()->delete();
        }catch (\Exception $e) {
            return $e->getMessage();
        }

    }
}
