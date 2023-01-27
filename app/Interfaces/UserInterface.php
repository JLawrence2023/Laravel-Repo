<?php

namespace App\Interfaces;

interface UserInterface
{
    public function getAllUsers();

    public function findUserById($id);

    public function createUser($data);

    public function updateUser($id, $data);

    public function deleteUser($id);
}
