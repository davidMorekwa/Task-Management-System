<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TasksController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::group(['middleware' => ['auth', 'verified']], function (){
    Route::get('/', [TasksController::class, 'getPendingTasks'])->name('user.home'); // shows pending tasks
    Route::get('/completed', [TasksController::class, 'getCompletedTasks'])->name('user.completed'); // shows completed tasks
    Route::get('/overdue', [TasksController::class, 'getOverdueTasks'])->name('user.overdue'); // shows overdue tasks
    Route::put('/tasks/complete/${id}', [TasksController::class, 'completeTask'])->name('user.complete'); // completes task
    Route::resource('tasks', TasksController::class);
    Route::get('/admin/dashboard', [TasksController::class, 'adminIndex'])->name('admin.dashboard')->middleware('role');
    Route::get('/admin/create-task', [TasksController::class, 'adminCreate'])->name('admin.create')->middleware('role');
    Route::post('/admin/store-task', [TasksController::class, 'adminStore'])->name('admin.store')->middleware('role');
    Route::get('/admin/show-task/${id}', [TasksController::class, 'adminShow'])->name('admin.show')->middleware('role');
    Route::put('/admin/update-task/${id}', [TasksController::class, 'adminUpdate'])->name('admin.update')->middleware('role');
    Route::delete('/admin/delete-task/${id}', [TasksController::class, 'adminDestroy'])->name('admin.destroy')->middleware('role');
    
});
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
