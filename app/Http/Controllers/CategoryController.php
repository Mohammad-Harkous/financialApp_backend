<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    //get category names to display them in a list 
    public function index()
    {

        return Category::all('name', 'id');
    }
    //create a new category  to add it in a list
    public function store(Request $request)
    {
        
            return Category::create($request->all());

        }
    

    public function destroy(Request $id)
    {
        
        $category = Category::find($id);
        if ($category) {
            $category->delete();
            return response()->json(['message' => 'category deleted successfully']);
        }

    }
}