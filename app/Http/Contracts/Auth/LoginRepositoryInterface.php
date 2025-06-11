<?php

namespace App\Http\Contracts\Auth;

interface LoginRepositoryInterface
{
    /**
     * Attempt to log in the user with the provided credentials.
     *
     * @param array $credentials User credentials for authentication.
     * @return bool True if login is successful, false otherwise.
     */
    public function login(array $credentials): bool;

    /**
     * Log the user out.
     *
     * @return void
     */
    public function logout(): void;
}
