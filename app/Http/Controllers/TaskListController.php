<?php

namespace App\Http\Controllers;

use App\Models\TaskList;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class TaskListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return Auth::user()->lists;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Model
     */
    public function store(Request $request): Model
    {
        $user = Auth::user();
        /** @var User $user */
        return $user->lists()->create($request->all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param TaskList $list
     * @return TaskList
     */
    public function update(Request $request, TaskList $list): TaskList
    {
        $list->update($request->all());

        return $list;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param TaskList $list
     * @return bool|null
     */
    public function destroy(TaskList $list): ?bool
    {
        return $list->delete();
    }
}
