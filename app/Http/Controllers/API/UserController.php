<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\User\UpdateRequest;
use App\User;
use Illuminate\Http\Request;

class UserController extends ApiResponseController
{

    public function index()
    {
        return $this->responseSuccess(User::all(), 'retrieved successfully.');
    }

    public function store(Request $request)
    {

    }

    public function show($id)
    {
        //
    }

    public function update(UpdateRequest $request, $id)
    {

        $user = User::find($id);

        $user->update($request->except('id', 'role', 'password', 'created_at', 'remember_token'));

        return $this->responseSuccess($request->all(), 'update successfully.');
    }

    public function destroy($id)
    {
        //
    }

    public  function upload()
    {
        //
    }
}
