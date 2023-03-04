<?php

namespace App\Models;

use App\Models\Users;
use App\Enums\GoalType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Goal extends Model
{
    use HasFactory;
      /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'amount',
        'start_date',
        'end_date',
        
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'type' => GoalType::class
    ];

    // public function user():  BelongsTo {
    //     return $this->belongsTo(Users::class);
    // }
}
