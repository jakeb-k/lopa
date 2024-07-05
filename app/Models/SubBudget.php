<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubBudget extends Model
{
    use HasFactory;
    
    protected $guarded = []; 

    protected $casts = [
        'amount' => 'float',
        'progress' => 'float',
        'over' => 'boolean',
        'user_id' => 'integer',
        'budget_id' => 'integer',

    ];


    function budget(){
        return $this->belongsTo('App\Model\Budget'); 
    }
}
