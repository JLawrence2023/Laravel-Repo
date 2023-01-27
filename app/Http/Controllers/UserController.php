<?php

namespace App\Http\Controllers;

use Exception;
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->userInterface->getAllUsers();

        return new UserResource(['data'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name',
            'email',
            'first_name',
            'last_name',
            'age',
        ]);

        $user = $this->userInterface->createUser($request->all());
        return new UserResource($user);
    }

    public function show($id)
    {
        $user = $this->userInterface->findUserById($id);
        return new UserResource($user);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'age' => 'required',
        ]);

        $user = $this->userInterface->updateUser($id, $request->all());
        return response()->json([
            'message' => 'Update successfully :) '
        ], 200);

    }

    public function destroy($id)
    {
        $this->userInterface->deleteUser($id);
        return response()->json(['message' => 'User deleted successfully']);
    }
}
