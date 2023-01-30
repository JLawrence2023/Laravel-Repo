<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\UserInterface;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    protected $userInterface;

    public function __construct(UserInterface $userInterface)
    {
        $this->userInterface = $userInterface;
    }

    public function index()
    {
        $users = $this->userInterface->getAllUsers();

        return new UserResource(['data'=>$users]);
    }

    public function store(Request $request)
    {
        $user = $this->userInterface->createUser($request->all());
        return response()->json([
            'message' => 'Data created successfully',
            'data' => new UserResource($user)
        ], 201);
    }

    public function show($id)
    {
        $user = $this->userInterface->findUserById($id);
        return new UserResource($user);
    }

    public function update(Request $request, $id)
    {
        $user = $this->userInterface->updateUser($id, $request->all());
        $updatedUser = $this->userInterface->findUserById($id);
        return response()->json([
            'message' => 'Data update successfully!',
            'data' => $updatedUser
        ], 200);
    }

    public function destroy($id)
    {
        $this->userInterface->deleteUser($id);
        return response()->json(['message' => "User with ID no.{$id}, deleted successfully"]);
    }
}
