<?php

namespace App\Http\Controllers;
use App\Models\Transactions;
use App\Models\RecTransactions;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class RecTransactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get the all recurrence transaction
        return RecTransactions::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     *
     */
    public function store(Request $request)
    {
        // post recurrence data transation
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'amount' => 'required',
            'currency' => 'required',
           
            'type_of_transaction' => 'required',
            'start_date' => 'required',


        ]);

        $rec_trans = RecTransactions::create($request->all());


        $rec_trans->user_id = $request->user_id;
        $rec_trans->category_id = $request->category_id;
        $rec_trans->save();
        return $rec_trans;


    }

    /**
     * Display the specified resource.
     * 
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(string $id)
    {
        //getting a single recurrence transactin by id
        return RecTransactions::find($id);
    }

 
    public function update(Request $request, string $id)
    {
        //update the recurrence transaction 
        $recurrence = RecTransactions::find($id);
        $recurrence->update($request->all());
        return $recurrence;
    }

    /**
     * Remove the specified resource from storage.
     * 
     * 
     *  @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        //delete  the recurrence transaction  by id
        $Rec = RecTransactions::find($id);
        if ($Rec) {
            $Rec->delete(); 
            return response()->json(['message' => 'trasaction deleted successfully']);
        }



    }

    public function search($ent){
        return 
        RecTransactions::where('user_id','like','%'.$ent.'%')
        ->orwhere('title','like','%'.$ent.'%')
        ->orwhere('description','like','%'.$ent.'%')
        ->orwhere('amount','like','%'.$ent.'%')
        ->orwhere('currency','like','%'.$ent.'%')
        ->orwhere('type_of_transaction','like','%'.$ent.'%')
        ->orwhere('start_date','like','%'.$ent.'%')->get();
        
       
        
      
    }

    public function end ( $id,$date){
        $rec=RecTransactions::find($id);
        if ($rec){
            $transaction = new Transactions();
            $transaction->user_id = $rec->user_id;
            $transaction->category_id= $rec->category_id;
            $transaction->title = $rec->title;
            $transaction->description = $rec->description;
            $transaction->amount = $rec->amount;
            $transaction->currency = $rec->currency;
            $transaction->D_O_T =$date;
            $transaction->type_of_transaction = $rec->type_of_transaction;
            $saved=$transaction->save();
           if($saved){
            $rec->delete();
            return response()->json(['message'=>'Transaction completed']);
           }
           return response()->json(['message'=>'failed to complete transaction ']);


           
            



        }




    }
}