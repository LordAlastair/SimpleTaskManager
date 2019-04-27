<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;

class TaskController extends Controller
{
  public function getAll(){
    $task = Task::orderby('presentation_order','asc')->get()->toArray();
    return $task;
  }

  public function getById(Task $task){
    return $task;
  }

  public function store (Request $request){
    $task = Task::create($request->all());

    return response()->json($request, 201);
  }

  public function update(Task $task){
    $task->update($task->all());

    return response()->json($task, 200);
  }

  public function delete(Task $task)
  {
      $task->delete();

      return response()->json(null, 200);
  }
}
