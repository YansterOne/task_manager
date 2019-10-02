<?php

namespace Core\User;

interface UserFactory
{
    public function create(string $username, string $password): User;
}
