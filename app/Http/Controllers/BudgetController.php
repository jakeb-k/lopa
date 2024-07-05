<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Subbudget; 
use Illuminate\Support\Facades\Auth; 


class BudgetController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $budgets = Budget::with('subbudgets')->where('user_id', Auth::user()->id)->get();
    
        return Inertia::render('Dashboard', [
            'budgets' => $budgets
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    /**
     * Creates a random rbg to be used in the graphs
     * is stored in db for persistance
     * @return String
     */
    function getRandomRGBColor() {
        $r = rand(0, 255);
        $g = rand(0, 255);
        $b = rand(0, 255);
        return "rgb($r, $g, $b)";
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user(); 
        try {
        $validatedData =$request->validate([
            'amount'=>'required|numeric|gt:0',
            'progress'=>'required|numeric|gte:0',
            'name'=>'required|string',
        ]);
        $budget = new Budget;

        $budget->amount = $validatedData['amount']; 
        $budget->progress = $validatedData['progress'];
        $budget->name = $validatedData['name']; 
        $budget->user_id = $user->id; 
        $budget->color = $this->getRandomRGBColor(); 
        $budget->save(); 
        //for making it for multiple people youd need to search by their id
        //or destruction would ensue
        $budgetTotal = Budget::where('name', '!=', 'Income')->where('user_id', $user->id)->sum('amount');

        $incomeBudget = Budget::where('name', 'Income')->where('user_id', $user->id)->first(); 

        $incomeTotal = Budget::where('name', 'Income')->where('user_id', $user->id)->sum('amount');

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
        } catch(\Exception $e){
            return $this->index()->with('error', $e); 
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
        $user = Auth::user(); 
        $budget = Budget::find($id); 
        
        $validatedData = $request->validate([
            'amount' => 'required|numeric|gte:0',
            'progress' => 'required|numeric|gte:0',
            'name'=>'required'
        ]);

        if($budget) {
            $budget->update([
                'amount'=> $validatedData['amount'],
                'progress'=> $validatedData['progress'],
                'name' => $validatedData['name'],
                'over'=> false,
                'user_id'=> Auth::user()->id, 
            ]);
        }

        //for making it for multiple people youd need to search by their id
        //or destruction would ensue
        $budgetTotal = Budget::where('name', '!=', 'Income')->where('user_id', $user->id)->sum('amount');

        $incomeBudget = Budget::where('name', 'Income')->where('user_id', $user->id)->first(); 

        $incomeTotal = Budget::where('name', 'Income')->where('user_id', $user->id)->sum('amount');

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
        $user = Auth::user(); 
        $budget = Budget::find($id);
        if(isset($budget)){
            $budget->delete(); 
        }
        //for making it for multiple people youd need to search by their id
        //or destruction would ensue
        $budgetTotal = Budget::where('name', '!=', 'Income')->where('user_id', $user->id)->sum('amount');

        $incomeBudget = Budget::where('name', 'Income')->where('user_id', $user->id)->first(); 

        $incomeTotal = Budget::where('name', 'Income')->where('user_id', $user->id)->sum('amount');

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
            session()->flash('success', 'Your Sub Budget was successfully deleted!'); 

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

        $subBudget->save(); 
        session()->flash('success', 'Your Sub Budget was successfully updated!'); 


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
    public function storeSub(Request $request)
    {
        $validatedData =$request->validate([
            'amount'=>'required|numeric|gt:0',
            'name'=>'required|string',
            'budgetId'=>'required',
            
        ]);
        

        $subBudget = new Subbudget; 
        $subBudget->user_id = 1;
        $subBudget->name = $validatedData['name'];
        $subBudget->amount = $validatedData['amount']; 
        $subBudget->budget_id = $validatedData['budgetId'];
        $subBudget->paid = $request->isPaid; 
      
        $subBudget->save();

        session()->flash('success', 'Your Sub Budget was successfully added!'); 


        // //for making it for multiple people youd need to search by their id
        // //or destruction would ensue
        // $budgetTotal = Budget::where('name', '!=', 'Income')->sum('amount');

        // $incomeBudget = Budget::where('name', 'Income')->first(); 

        // $incomeTotal = Budget::where('name', 'Income')->sum('amount');

        // if($budgetTotal > $incomeTotal) {
        //     $msg = 'Your '.$budget->name.' budget was created!';
        //     $incomeBudget->over = true; 
        //     session()->flash('success', $msg);
        //     $incomeBudget->save(); 
        // } else {
        //     $msg = 'Your '.$budget->name.' budget was created!';
        //     session()->flash('success', $msg); 
        //     $incomeBudget->over = false; 
        //     $incomeBudget->save();
        // }

     }
}
