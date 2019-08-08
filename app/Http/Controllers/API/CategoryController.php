<?php

namespace App\Http\Controllers\API;

use App\Category;
use App\Http\Requests\Category\StoreRequest;
use App\Http\Requests\Category\UpdateRequest;

class CategoryController extends ApiController
{

    public function index()
    {
        return $this->responseSuccess(Category::all(), 'retrieved successfully.');
    }

    public function store(StoreRequest $request)
    {
        $category = Category::create($request->only('name'));

        return $this->responseSuccess($category, 'save successfully.');
    }

    public function show($id)
    {
        $category = Category::find($id);

        return $category ? $this->responseSuccess($category, 'retrieved successfully.') : $this->responseError('not found', 'this category does not exist');
    }

    public function update(UpdateRequest $request, $id)
    {
        $category = Category::find($id);

        if (!$category) return $this->responseError('not found', 'this category does not exist');

        $category->update($request->only('name'));

        return $this->responseSuccess($request->only('name'), 'update successfully.');
    }

    public function destroy($id)
    {
        $category = Category::find($id);

        if (!$category) return $this->responseError('not found', 'this category does not exist');

        $category->delete();

        return $this->responseSuccess($category, 'deleted successfully.');
    }

}
