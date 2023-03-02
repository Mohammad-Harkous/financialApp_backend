<?php

namespace App\Http\Controllers;

use App\Models\RecTransactions;
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
        $request->validate ([
            'title' => 'required',
            'description' => 'required',
            'amount' => 'required',
            'currency' => 'required',
            'D_O_T' => 'required',
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

    /**
     * Update the specified resource in storage.
     *  @param  \Illuminate\Http\Request $request
     *  @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $id)
    {
        //update the recurrence transaction 
        $recurrence = RecTransactions::find($id);
        $recurrence ->update($request->all());
        return $recurrence;
    }
    
    /**
     * Remove the specified resource from storage.
     * 
     * 
     *  @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id)
    {
       
        //delete  the recurrence transaction  by id
        return RecTransactions::destroy($id);
      
        
    }


    /**
     * search for a recurrence
     * 
     * @param str $title
     * @return \Illuminate\Http\Response
     */
    public function search(string $id)
    {
        //delete  the recurrence transaction  by id
        return RecTransactions::where('title','like','%'.$title.'%')->get();

    }


}
