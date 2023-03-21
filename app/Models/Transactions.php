<?php

namespace App\Models;

use App\Models\Users;
use App\Models\Category;
use App\Enums\TransactionType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transactions extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'amount',
        'currency',
        'D_O_T',
        'type_of_transaction',
        'user_id',
        'category_id'
    ];

  
    // protected $casts = [
    //     'type_of_transaction' => \App\Enums\TransactionType::class
    // ];

  

    public function user(): BelongsTo
    {
        return $this->belongsTo(Users::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}