<?php

namespace App\Http\Controllers\API;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends ApiResponseController
{

    public function index()
    {
        return $this->responseSuccess(Category::all(), 'retrieved successfully.');
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
        //
    }

    public function destroy($id)
    {
        //
    }

}
