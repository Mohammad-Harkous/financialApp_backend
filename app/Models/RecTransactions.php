<?php

namespace App\Models;

use App\Models\Users;
use App\Models\Category;
use App\Enums\TransactionType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RecTransactions extends Model
{
    use HasFactory;  /**
    * The attributes that are mass assignable.
    *
    * @var array<int, string>
    */
   protected $fillable = [
       'title',
       'description',
       'amount',
       'currency',
       'type_of_transaction',
       'start_date',
       'end_date',
       'user_id',
       'category_id',
       
   ];

   /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'type_of_transaction' => TransactionType::class
    ];
    

    public function user():  BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function category():  BelongsTo {
        return $this->belongsTo(Category::class);
    }

}
