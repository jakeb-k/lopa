<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubBudget extends Model
{
    use HasFactory;
    
    protected $fillable = ['budget_id','name','amount','paid']; 

    function budget(){
        return $this->belongsTo('App\Model\Budget'); 
    }
}
