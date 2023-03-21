<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use App\Models\Goal;
use App\Models\Transactions;
use Carbon\Carbon;
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

    public function activate ($id){
        $goals=Goal::where('status','active')->first();
        $thegoal=Goal::find($id);
        if($goals){
            return response(['message'=>'you already have an active goal']);
        }
        $thegoal->update('status','active');
        return response(['message'=>'goal activated !']);
    }

    public function active()
    {
        $goal = Goal::where('status', 'active')->first();
       
        $start =Carbon::parse($goal->start_date) ;
        $end=Carbon::parse($goal->end_date);
        $income = Transactions::whereBetween('D_O_T',[$start,$end] )->where('type_of_transaction', 'like', 'income')->get();
        $totalI = $income->sum('amount');
        $expense = Transactions::whereBetween('D_O_T',[$start,$end] )->where('type_of_transaction', 'like', 'expense')->get();
        $totalE = $expense->sum('amount');
        $total = $totalI-$totalE ;
        $percent = $total*100/$goal->amount;

        $response = [
             $goal,
            'income' => $totalI,
            'expense' => $totalE,
            'target' => $total,
            'percent' => $percent,
        ];
        return response($response, 202);
    }
}
