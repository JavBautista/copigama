<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;


class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(10);
        return $categories;
    }


    public function store(Request $request)
    {
        $category =new Category();
        $category->active = 1;
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();
        return response()->json([
            'ok'=>true,
            'category' => $category,
        ]);
    }

    public function update(Request $request)
    {
        $category = category::findOrFail($request->id);
        $category->description = $request->description;
        $category->name = $request->name;
        $category->save();
        return response()->json([
            'ok'=>true,
            'category' => $category,
        ]);
    }


    public function destroy($id)
    {
        $category=category::destroy($id);
    }
}
