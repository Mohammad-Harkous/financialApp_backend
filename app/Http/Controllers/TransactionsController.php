<?php

namespace App\Http\Controllers;

use App\Models\Transactions;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{
    public function store(Request $request)
    {
        // post recurrence data transation
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'amount' => 'required',
            'currency' => 'required',
            'type_of_transaction' => 'required',
            'D_O_T' => 'required',
            'user_id'=>'required',
            'category_id'=>'required',


        ]);

        $trans = Transactions::create($request->all());


        $trans->user_id = $request->user_id;
        $trans->category_id = $request->category_id;
        $trans->save();
        return response(['message'=>'trasaction created successfully']);


    }

    public function update(Request $request, string $id)
    {
        //update the recurrence transaction 
        $recurrence = Transactions::find($id);
        $recurrence->update($request->all());
        return $recurrence;
    }
    
    public function search($ent){
        return 
        Transactions::where('user_id','like','%'.$ent.'%')
        ->orwhere('title','like','%'.$ent.'%')
        ->orwhere('description','like','%'.$ent.'%')
        ->orwhere('amount','like','%'.$ent.'%')
        ->orwhere('currency','like','%'.$ent.'%')
        ->orwhere('type_of_transaction','like','%'.$ent.'%')
        ->orwhere('start_date','like','%'.$ent.'%')->get();
        
       
        
      
    }

    public function index (){
        $trans=Transactions::all();
        return $trans;
    }

    public function income(){
$trasaction=Transactions::where('type_of_transaction', 'like', 'income')->get();
return $trasaction;
    }
    
    public function expense(){
        $trasaction=Transactions::where('type_of_transaction', 'like', 'expense')->get();
        return $trasaction;
    }

    public function totals(){
$income=Transactions::where('type_of_transaction', 'like', 'income')->get();
$expense=Transactions::where('type_of_transaction', 'like', 'expense')->get();
$totalI=$income->sum('amount');
$totalE=$expense->sum('amount');
$total=$totalI-$totalE;

$response = [
   
   'income' => $totalI,
   'expense' => $totalE,
   'total' => $total,
   
];
return response($response, 202);
    }
}

