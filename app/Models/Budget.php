<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    use HasFactory;

    protected $fillable = ['name','amount','progress',];

    function user(){
        return $this->belongsTo('App\Models\User'); 
    }
}
