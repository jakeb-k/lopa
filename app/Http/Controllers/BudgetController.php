<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Subbudget; 
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;



class BudgetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $budgets = Budget::with('subbudgets')->get();

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
        $validatedData =$request->validate([
            'amount'=>'required|numeric|gt:0',
            'progress'=>'required|numeric|gte:0',
            'title'=>'required|string'
        ]);
        $budget = new Budget;

        $budget->amount = $validatedData['amount']; 
        $budget->progress = $validatedData['progress'];
        $budget->name = $validatedData['title']; 
        $budget->user_id = 1; 
        $budget->over = false; 
        $budget->save(); 

        //for making it for multiple people youd need to search by their id
        //or destruction would ensue
        $budgetTotal = Budget::where('name', '!=', 'Income')->sum('amount');

        $incomeBudget = Budget::where('name', 'Income')->first(); 

        $incomeTotal = Budget::where('name', 'Income')->sum('amount');

        if($budgetTotal > $incomeTotal) {
            $msg = 'Your '.$budget->name.' budget was created!';
            $incomeBudget->over = true; 
            session()->flash('success', $msg);
            $incomeBudget->save(); 
        } else {
            $msg = 'Your '.$budget->name.' budget was created!';
            session()->flash('success', $msg); 
            $incomeBudget->over = false; 
            $incomeBudget->save();
        }

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
            'progress' => 'required|numeric|gte:0',
            'name'=>'required'
        ]);

        $budget->amount = $validatedData['amount'];
        $budget->name = $validatedData['name']; 
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
        if(isset($budget)){
            $budget->delete(); 
        }
        //for making it for multiple people youd need to search by their id
        //or destruction would ensue
        $budgetTotal = Budget::where('name', '!=', 'Income')->sum('amount');

        $incomeBudget = Budget::where('name', 'Income')->first(); 

        $incomeTotal = Budget::where('name', 'Income')->sum('amount');

        if($budgetTotal > $incomeTotal) {
            $incomeBudget->over = true; 
            $incomeBudget->save(); 
        } else {
            $incomeBudget->over = false; 
            $incomeBudget->save();
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroySub($id)
    {

        $subBudget = SubBudget::find($id);
        if(isset($subBudget)){
            $subBudget->delete(); 
        }

        //for making it for multiple people youd need to search by their id
        //or destruction would ensue
        // $budgetTotal = Budget::where('name', '!=', 'Income')->sum('amount');

        // $incomeBudget = Budget::where('name', 'Income')->first(); 

        // $incomeTotal = Budget::where('name', 'Income')->sum('amount');

        // if($budgetTotal > $incomeTotal) {
        //     $incomeBudget->over = true; 
        //     $incomeBudget->save(); 
        // } else {
        //     $incomeBudget->over = false; 
        //     $incomeBudget->save();
        // }

    }
     /**
     * Update the specified resource in storage.
     */
    public function updateSub(Request $request, $id)
    {
        $subBudget = SubBudget::find($id); 
        
        $validatedData = $request->validate([
            'amount' => 'required|numeric|gte:0',
            'name' => 'required',
            'isPaid' => 'required'
        ]);

        $subBudget->amount = $validatedData['amount'];
        $subBudget->paid = $validatedData['isPaid']; 
        $subBudget->name = $validatedData['name']; 
        // $budget->progress = $validatedData['progress'];

        $subBudget->save(); 

        //for making it for multiple people youd need to search by their id
        //or destruction would ensue
        // $budgetTotal = Budget::where('name', '!=', 'Income')->sum('amount');

        // $incomeBudget = Budget::where('name', 'Income')->first(); 

        // $incomeTotal = Budget::where('name', 'Income')->sum('amount');

        // if($budgetTotal > $incomeTotal) {
        //     $incomeBudget->over = true; 
        //     $incomeBudget->save(); 
        // } else {
        //     session()->flash('success', 'Your budget was successfully updated!'); 
        //     $incomeBudget->over = false; 
        //     $incomeBudget->save();
        // }

    }
}
