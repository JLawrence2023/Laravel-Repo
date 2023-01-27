<?php
namespace App\Repositories;

use App\Models\User;
use App\Interfaces\UserInterface;
use App\Repositories\UserRepository;

class UserRepository implements UserInterface
{
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function getAllUsers()
    {
        return $this->model->all();
    }
    public function findUserById($id)
    {
        return $this->model->find($id);
    }

    public function createUser($data)
    {
        return $this->model->create($data);
    }

    public function updateUser($id, $data)
    {
        $User = $this->findUserById($id);
        return $User->update($data);
    }

    public function deleteUser($id)
    {
        $User = $this->findUserById($id);
        return $User->delete();
    }
}
