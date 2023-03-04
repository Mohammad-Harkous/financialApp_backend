<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use App\Models\Goal;

class GoalController extends Controller
{
    //get category names to display them in a list 
    public function index()
    {

        return Goal::all();
    }
    //create a new category  to add it in a list
    public function store(Request $request)
    {
        $request->validate([
'title'=>'required',
'amount'=>'required|numeric',
'start_date'=>'required',
'end_date'=>'required',
        ]);
            return Goal::create($request->all());

        }
    

    public function destroy($id)
    {
        
        $goal = Goal::find($id);
        if ($goal) {
            $goal->delete();
            return response()->json(['message' => 'category deleted successfully']);
        }

    }
}