<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

trait RegisterUtilities
{
    public function createUser($auth = false)
    {
        $this->validate();
        if (! $this->isPhoneNumberUnique($this->phone)) {
            $this->addError('phone', __('This phone number is already used by another user.'));

            return null;
        }

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'phone' => $this->phone,
        ]);

        if ($auth) {
            auth()->login($user);
        }

        return $user;
    }

    public function isPhoneNumberUnique($phone): bool
    {
        return User::where('phone', $phone)->count() === 0;
    }
}
