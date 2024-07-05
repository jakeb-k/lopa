<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    use HasFactory;

    protected $guarded = []; 
    
    protected $casts = [
        'amount' => 'float',
        'progress' => 'float',
        'over' => 'boolean',
        'user_id' => 'integer',
    ];

    function user(){
        return $this->belongsTo('App\Models\User'); 
    }
    function subbudgets(){
        return $this->hasMany('App\Models\Subbudget'); 
    }
}
