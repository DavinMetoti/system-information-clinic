<?php

namespace App\Http\Repositories\Auth;

use App\Http\Contracts\Auth\LoginRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class LoginRepository implements LoginRepositoryInterface
{
    /**
     * Attempt to log in the user with the provided credentials.
     *
     * @param array $credentials User credentials for authentication.
     * @return bool True if login is successful, false otherwise.
     */
    public function login(array $credentials): bool
    {
        return Auth::attempt($credentials);
    }

    /**
     * Log the user out.
     *
     * @return void
     */
    public function logout(): void
    {
        Auth::logout();
    }
}
