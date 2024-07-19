<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TasksController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::group(['middleware' => ['auth', 'verified']], function (){
    Route::get('/', function () {
        return Inertia::render('UserViews/UserView');
    })->name('user.home'); // shows pending tasks
    Route::get('/completed', function () {
        return Inertia::render('UserViews/CompletedTask');
    })->name('user.completed'); // shows completed tasks
    Route::get('/overdue', function () {
        return Inertia::render('UserViews/OverdueTasks');
    })->name('user.overdue'); // shows overdue tasks
    Route::resource('tasks', TasksController::class);
    // Route::get('tasks/create', [TasksController::class, 'create'])->name('tasks.create');

});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
