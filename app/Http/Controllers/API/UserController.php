<?php

namespace App\Http\Controllers\API;

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
        //
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {
        //
    }
}
