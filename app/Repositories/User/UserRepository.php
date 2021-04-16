<?php

namespace App\Repositories\User;

interface UserRepository
{
    /**
     * Create new user.
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    public function findUser();

    public function logout(object $data);
}
