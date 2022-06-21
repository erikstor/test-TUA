<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // todo hacer la parte de administrador y de usuario normal
        $tasks = Task::where('user_id', auth()->user()->id)->select([
            'id',
            'title',
            'status',
        ])->get();

        return view('tasks.list', ['tasks' => $tasks]);
    }


    public function getQuantityTasks()
    {

        $tasks = Task::where('user_id', auth()->user()->id)->get()->count();

        return response()->json($tasks);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
        ]);

        $task = new Task();

        //todo agregar transacciones

        try {
            $task->title = $request->title;
            $task->description = $request->description;
            $task->status = 1;
            $task->user_id = auth()->user()->id;

            $task->save();
        } catch (\Exception $exception) {
            return response()->json(["code" => $exception->getCode(), "msg" => $exception->getMessage()]);
        }

        return response()->json('ok');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Task $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return response()->json($task);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Task $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Task $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {

        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'id' => 'required|integer:tasks'
        ]);

        //todo agregar transacciones

        try {
            $task->title = $request->title;
            $task->description = $request->description;

            $task->save();
        } catch (\Exception $exception) {
            return response()->json(["code" => $exception->getCode(), "msg" => $exception->getMessage()]);
        }

        return response()->json('ok');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Task $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {

        //todo agregar transacciones

        try {

            if(!$task->id){
                throw new \Error('Tasks Not Found', 404);
            }

            $task->delete();

        } catch (\Exception $exception) {
            return response()->json(["code" => $exception->getCode(), "msg" => $exception->getMessage()]);
        }

        return response()->json('ok');

    }
}
