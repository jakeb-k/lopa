<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;


class BudgetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $budgets = Budget::all(); 

        return $budgets; 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $budget = Budget::find($id); 
      
        return $budget;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Budget $budget)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
       $budget = Budget::find($id); 

       $validatedData = $request->validate([
        'amount' => 'required|numeric|gte:0',
        'progress' => 'required|numeric|gte:0'
        ]);
        $budget->amount = $validatedData['amount'];
        $budget->progress = $validatedData['progress'];
        
        if($budget->amount < $budget->progress){
            session()->flash('message', 'Progress cannot exceed the Total!');
        } else {
            session()->flash('success', 'Budget was Updated!');
            $budget->save(); 
        }

        Inertia::location(url('/'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Budget $budget)
    {
        //
    }
}
