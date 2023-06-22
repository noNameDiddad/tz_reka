<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskList;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param TaskList $list
     * @return mixed
     */
    public function index(TaskList $list)
    {
        return $list->tasks;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param TaskList $list
     * @return Model
     */
    public function store(Request $request, TaskList $list): Model
    {
        return $list->tasks()->create($request->all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Task $task
     * @return Task
     */
    public function update(Request $request, Task $task)
    {
        $task->update($request->all());

        return $task;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Task $task
     * @return bool|null
     */
    public function destroy(Task $task): ?bool
    {
        return $task->delete();
    }

    /**
     * Mark task as done or undone
     *
     * @param Task $task
     * @return bool
     */
    public function markAsDoneUndone(Task $task): bool
    {
        $task->is_done = $task->is_done ? false : true;
        return $task->save();
    }
}
