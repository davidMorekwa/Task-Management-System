<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class APIController extends Controller
{
    /*
    * Get all tasks
    */
    public function adminGetAllTasks(){
        return Task::all();
    }
    /*
    * Get a task by id
    */
    public function getTask($id){
        // return $id;
        return Task::find($id);
    }
    /* 
     * Get all completed tasks by user
    */
    public function getCompletedTasks(){
        $user = Auth::user();
        return Task::where('status', 'completed')->where('person_assigned', $user->id)->get();
    }
    /* 
     * Get all pending tasks by user
     * TODO: Get for authenticated user
    */
    public function getPendingTasks(){
        $user = Auth::user();
        return Task::where('status', 'pending')->where('person_assigned', $user->id)->get();
    }
    /* 
     * Get all overdue tasks by user
     * TODO: Get for authenticated user
    */
    public function getOverdueTasks(){
        $user = Auth::user();
        return Task::where('status', 'overdue')->where('person_assigned', $user->id)->get();
    }
    /* 
    * Admin create task
     */
    public function adminCreateTask(Request $request){
        $validatedData = $request->validate([
            'task_name' => 'required',
            'description' => 'required',
            'due_date' => 'required',
            'person_assigned' => 'required'
        ]);
        $task = Task::create([
            'task_name' => $validatedData['task_name'],
            'description' => $validatedData['description'],
            'due_date' => $validatedData['due_date'],
            'status' => 'pending',
            'person_assigned' => $validatedData['person_assigned'],
        ]);
        if($task!=null){
            return response()->json(['message' => 'Task created successfully'], 200);
        } else {
            return response()->json(['message' => 'Task creation failed'], 500);
        }
    }
    public function adminDeleteTask($id){
        $task = Task::find($id);
        if($task!=null){
            $task->delete();
            return response()->json(['message' => 'Task deleted successfully'], 200);
        } else {
            return response()->json(['message' => 'Task deletion failed'], 500);
        }
    }
    public function adminUpdateTask(Request $request, $id){
        $task = Task::find($id);
        if($task!=null){
            $validatedData = $request->validate([
                'task_name' => 'required',
                'description' => 'required',
                'due_date' => 'required',
                'person_assigned' => 'required',
            ]);
            $task->task_name = $validatedData['task_name'];
            $task->description = $validatedData['description'];
            $task->due_date = $validatedData['due_date'];
            $task->person_assigned = $validatedData['person_assigned'];
            $task->save();
            return response()->json(['message' => 'Task updated successfully'], 200);
        } else {
            return response()->json(['message' => 'Task update failed'], 500);
        }
    }
}
