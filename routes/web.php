<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BudgetController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

Route::get('/', function () {
    return Inertia::render('Home', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('budget', BudgetController::class); 

    Route::post('/subbudget', [BudgetController::class, 'storeSub'])->name('subbudget.create'); 
    Route::put('/subbudget/{id}', [BudgetController::class, 'updateSub'])->name('subbudget.update'); 
    Route::delete('/subbudget/{id}', [BudgetController::class, 'destroySub'])->name('subbudget.delete'); 


    Route::get('/dashboard',[BudgetController::class, 'index'])->name('dashboard');

});

Route::get('auth/{driver}/redirect', function (Request $request) {
    return Socialite::driver($request->driver)->redirect();
})->name('auth.redirect');

Route::get('/auth/{driver}/callback', function (Request $request) {
    $user = Socialite::driver($request->driver)->user();

    // Find or create the user in your database
    $user = User::firstOrCreate([ 
        'email' => $user->getEmail(),
        'name' => $user->getName(), 
        'provider_id' => $user->getId()
    ]);

    // Log the user in
    Auth::login($user);

    return redirect(route('dashboard'));

})->name('auth.callback');
require __DIR__.'/auth.php';
