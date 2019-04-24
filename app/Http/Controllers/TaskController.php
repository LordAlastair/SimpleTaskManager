<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Aap\Task;

class TaskController extends Controller
{
  public function getAll(){
    return Task::all();
  }

  public function getById(Task $task){
    return $task;
  }

  public function store (Request $request){
    $task = Task::create($request->all());

    return response()->json($article, 201);
  }

  public function update(Request $request, Task $task){
    $task->update($request->all());

    return response()->json($article, 200);
  }

  public function delete(Task $task)
  {
      $task->delete();

      return response()->json(null, 204);
  }
}
