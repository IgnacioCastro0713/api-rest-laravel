<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\Post\StoreRequest;
use App\Http\Requests\Post\UpdateRequest;
use App\Http\Requests\Post\UploadRequest;
use App\Post;

class PostController extends ApiController
{

    public function index()
    {
        return $this->responseSuccess(Post::with('category')->get(), 'retrieved successfully.');
    }

    public function store(StoreRequest $request)
    {
        $request->merge(['user_id' => auth()->id()]);

        $post = Post::create($request->except('created_at', 'updated_at'));

        return $this->responseSuccess($post, 'save successfully.');
    }

    public function show($id)
    {
        $post = Post::with('category')->find($id);
        return $post ? $this->responseSuccess($post, 'retrieved successfully.') : $this->responseError('not found', 'this post does not exist ');
    }

    public function update(UpdateRequest $request, $id)
    {
        $post = Post::find($id);

        if (!$post || $post->user_id != auth()->id())
            return $this->responseError('not found', 'this category does not exist or you do not have permission to update');

        $post->update($request->except('id', 'user_id', 'created_at', 'updated_at'));

        return $this->responseSuccess($request->all(), 'update successfully.');
    }

    public function destroy($id)
    {
        $post = Post::find($id);

        if (!$post || $post->user_id != auth()->id())
            return $this->responseError('not found', 'this post does not exist or you do not have permission to delete');

        $post->delete();

        return $this->responseSuccess($post, 'deleted successfully.');
    }

    public function upload(UploadRequest $request)
    {

    }
}
