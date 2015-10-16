<?php
/**
 * Created by PhpStorm.
 * User: kammer
 * Date: 16/10/15
 * Time: 11:38
 */

namespace CodeProject\OAuth;

use Illuminate\Support\Facades\Auth;

class Verifier
{
    public function verify($username, $password)
    {
        $credentials = [
            'email'    => $username,
            'password' => $password,
        ];

        if (Auth::once($credentials)) {
            return Auth::user()->id;
        }

        return false;
    }
}