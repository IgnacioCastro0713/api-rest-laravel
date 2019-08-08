<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\User\UpdateRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends ApiController
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
        $user = User::find($id);
        return $user ? $this->responseSuccess($user, 'retrieved successfully.') : $this->responseError('not found', 'this user does not exist');
    }

    public function update(UpdateRequest $request, $id)
    {

        $user = User::find($id);

        if (!$user) return $this->responseError('not found', 'this user does not exist');

        $user->update($request->except('id', 'role', 'password', 'created_at', 'remember_token'));

        return $this->responseSuccess($request->all(), 'update successfully.');
    }

    public function destroy($id)
    {
        //
    }

    public  function upload(Request $request)
    {
        $image = $request->file('file0');

        $validator = Validator::make($request->all(), [
            'file0' => 'required|image|mimes:jpg,jpeg,png,gif'
        ]);


        if ($image && !$validator->fails()) {

            $image_name = time().$image->getClientOriginalName();

            Storage::disk('users')->put($image_name, File::get($image));

            return $this->responseSuccess($image_name, 'save successfully');
        }

        return $this->responseError('bad request', $validator->errors(), 400);
    }

    public function getImage($filename)
    {
        if (!Storage::disk('users')->exists($filename)) {
            return $this->responseError('not found',  ['file' => 'file not found']);
        }

        $file = Storage::disk('users')->get($filename);

        return new Response($file, 200);
    }
}
