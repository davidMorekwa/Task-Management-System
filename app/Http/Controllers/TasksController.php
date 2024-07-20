<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

use function PHPSTORM_META\type;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // user create task
        
    }
    public function getCompletedTasks(){
        $tasks = Task::where('status', 'completed')->where('person_assigned', auth()->user()->id)->get();
        return Inertia::render('UserViews/CompletedTask', ['completedTasks'=> $tasks]);
    }
    public function getPendingTasks(){
        $tasks = Task::where('status', 'pending')->where('person_assigned', auth()->user()->id)->get();
        return Inertia::render('UserViews/UserView', ['pendingTasks'=> $tasks]);
    }
    public function getOverdueTasks(){
        $tasks = Task::where('person_assigned', auth()->user()->id)->where('status', 'overdue')->get();
        return Inertia::render('UserViews/OverdueTasks', ['overdueTasks'=> $tasks]);
    }
    public function completeTask($id){
        // user completes task
        $task = Task::find($id);
        $task->status = 'completed';
        $task->save();
        // return $task;
        return redirect()->route('user.home', ['message' => 'success']);
    }
    public function adminIndex(){
        $tasks = DB::table('tasks')
            ->join('users', 'tasks.person_assigned', '=', 'users.id')
            ->select('tasks.*', 'users.name')
            ->get();
        // dd($tasks);
        return Inertia::render('AdminViews/AdminDashboard', ['tasks' => $tasks]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('UserViews/CreateTask');
    }
    public function adminCreate(){
        $users = User::where('role_id', 2)->get();
        return Inertia::render('AdminViews/AdminCreateTask', ['users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // dd($request);
        $validatedData = $request->validate([
            'task_name' => 'required',
            'task_due_date' => 'required',
            'task_description' => 'required'
        ]);
        $userid = auth()->user()->id;
        $new_task = Task::create([
            'task_name' => $validatedData['task_name'],
            'description' => $validatedData['task_description'],
            'due_date' => $validatedData['task_due_date'],
            'person_assigned' => $userid,
            'status' => 'pending',
        ]);
        return redirect()->route('tasks.create');
        
    }
    public function adminStore(Request $request){
        // validate the request
        $validatedData = $request->validate([
            'task_name' => 'required',
            'task_description' => 'required',
            'due_date' => 'required',
            'person_assigned' => 'required|integer',
        ]);
        $new_task = Task::create([
                'name' => $validatedData['task_name'],
                'description' => $validatedData['task_description'],
                'due_date' => $validatedData['due_date'],
                'person_assigned' => $validatedData['person_assigned'],
                'status' => 'pending',
            ]);
        return redirect()->route('admin.dashboard');
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }
    public function adminShow($id){
        // dd($id);
        $task = Task::find($id);
        // dd($task);
        $users = User::where('role_id', 2)->get();
        return Inertia::render('AdminViews/AdminShowTask', ['task' => $task, 'users' => $users]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    { 
        // 
    }
    public function adminUpdate(Request $request, string $id){
        // dd($request);
        // validate the request
        $validatedData = $request->validate([
            'task_name' => 'required',
            'task_description' => 'required',
            'due_date' => 'required',
            'person_assigned' => 'required|integer',
        ]);
        $task = Task::find($id);
        $task->task_name = $validatedData['task_name'];
        $task->description = $validatedData['task_description'];
        $task->due_date = $validatedData['due_date'];
        $task->person_assigned = $validatedData['person_assigned'];
        $task->save();
        return redirect()->route('admin.dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function adminDestroy(string $id){
        $task = Task::find($id);
        $task->delete();
        return redirect()->route('admin.dashboard');
    }
}
