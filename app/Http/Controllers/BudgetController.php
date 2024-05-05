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

        $budget->save(); 

        //for making it for multiple people youd need to search by their id
        //or destruction would ensue
        $budgetTotal = Budget::where('name', '!=', 'Income')->sum('amount');

        $incomeBudget = Budget::where('name', 'Income')->first(); 

        $incomeTotal = Budget::where('name', 'Income')->sum('amount');

        if($budgetTotal > $incomeTotal) {
            $incomeBudget->over = true; 
            $incomeBudget->save(); 
        } else {
            session()->flash('success', 'Your budget was successfully updated!'); 
            $incomeBudget->over = false; 
            $incomeBudget->save();
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $budget = Budget::find($id);
        $budget->delete(); 

        return redirect()->back(); 
    }
}
