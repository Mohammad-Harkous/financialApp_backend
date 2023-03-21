<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transactions;
use App\Models\RecTransactions;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;


class ReportController extends Controller
{

  public function calculate($date)

  {
    $income_all=array();
    $expense_all=array();
    $total_all=array();
  
    $result=array();
   
    
    $months = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12',];
   
for($i=0;$i<12;$i++)
{
 
  $incomefeb = Transactions::where('D_O_T','like','%'."{$date}-{$months[$i]}".'%' )->where('type_of_transaction', 'like', 'income')->get('amount');
  $febincome=$incomefeb->sum('amount');
  $expensefeb = Transactions::where('D_O_T','like','%'."{$date}-{$months[$i]}".'%' )->where('type_of_transaction', 'like', 'expense')->get('amount');
  $febexpense=$expensefeb->sum('amount');
  $total=$febincome-$febexpense;
  array_push($income_all,$febincome);
  array_push($expense_all,$febexpense);
  array_push($total_all,$total);

        



  }
  array_push($result,(object) [
    'income' =>$income_all,
    'expense' =>$expense_all,
    'total' =>$total_all,
]);
  return $result;
}
}