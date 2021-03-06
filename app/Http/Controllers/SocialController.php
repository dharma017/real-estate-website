<?php

namespace App\Http\Controllers;

use Validator, Redirect, Response;
use Socialite;
use App\User;

class SocialController extends Controller
{

    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        $getInfo = Socialite::driver($provider)->user();
        $user = $this->createUser($getInfo, $provider);
        auth()->login($user);

        return redirect()->to('/agent/dashboard');
    }

    function createUser($getInfo, $provider)
    {
        $username   = strtok($getInfo->name, " ");
        $roleid     = 2;

        $user = User::where('provider_id', $getInfo->id)->first();
        if ( ! $user) {
            $user = User::create([
                'name' => $getInfo->name,
                'email' => $getInfo->email,
                'provider' => $provider,
                'provider_id' => $getInfo->id,
                'username'  => $username,
                'role_id'   => $roleid
            ]);
        }

        return $user;
    }
}
