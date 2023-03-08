<?php

namespace App\Models;


use App\Models\Transactions;
use App\Models\RecTransactions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{

    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name'

    ];

    public function  transactions(): HasMany
    {

        return $this->hasMany(Transactions::class);
    }

    public function  recTransactions(): HasMany
    {

        return $this->hasMany(RecTransactions::class);
    }
}
