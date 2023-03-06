<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use App\Models\Goal;
use PhpParser\Node\Stmt\Return_;

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
            'status' => 'required',
            'title' => 'required',
            'amount' => 'required|numeric',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);
        return Goal::create($request->all());

    }


    public function destroy($id)
    {

        $goal = Goal::find($id);
        if ($goal) {
            $goal->delete();
            return response()->json(['message' => 'Goal deleted successfully']);
        }

    }

    public function update(Request $request, $id)
    {
        $goal = Goal::find($id);
        $goal->update($request->all());
        return response()->json(['message' => 'goal updated successfully']);




    }

    public function active (){
        return Goal::where('status','active')->get();
    }
}