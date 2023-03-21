<?php

namespace App\Http\Controllers;

use App\Models\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class TransactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get the all recurrence transaction
        return Transactions::all();
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
            'category_id'=>'required'
            
        ]);

        log::info($request->all());

        // $trans = Transactions::create([
        //     $request->all()
        // ]);

        $trans = Transactions::create($request->all());

        $trans->user_id = $request->user_id;
        $trans->category_id = $request->category_id;
        $trans->save();
        // return $trans;

        
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
        return Transactions::find($id);
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
        $transo = Transactions::find($id);
        $transo ->update($request->all());
        return $transo;
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
        return Transactions::destroy($id);
      
        
    }


    /**
     * search for a recurrence
     * 
     * @param str $title
     * @return \Illuminate\Http\Response
     */
    public function search(string $title)
    {
        //delete  the recurrence transaction  by id
        return Transactions::where('title','like','%'.$title.'%')->get();

    }


}
