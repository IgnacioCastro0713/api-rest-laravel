<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\Post\StoreRequest;
use App\Http\Requests\Post\UpdateRequest;
use App\Http\Requests\Post\UploadRequest;
use App\Post;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class PostController extends ApiController
{

    public function index()
    {
        return $this->responseSuccess(Post::with('category')->get(), 'retrieved successfully.');
    }

    public function store(StoreRequest $request)
    {
        $request->merge(['user_id' => auth()->id()]);

        $post = Post::create($request->all());

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
        $image = $request->file('file0');

        if (!$image) return $this->responseError('bad request', 'error uploading image', 400);

        $image_name = time().$image->getClientOriginalName();

        Storage::disk('images')->put($image_name, File::get($image));

        return $this->responseSuccess($image_name, 'save successfully');
    }

    public function getImage($filename)
    {
        if (!Storage::disk('users')->exists($filename)) return $this->responseError('not found',  'image not exist');

        $file = Storage::disk('users')->get($filename);
        return new Response($file, 200);
    }

    public function getPostByCategory($id)
    {
        return $this->responseSuccess(Post::getPostByCategory($id), 'retrieved successfully.');
    }

    public function getPostByUser($id)
    {
        return $this->responseSuccess(Post::getPostByUser($id), 'retrieved successfully.');
    }
}
