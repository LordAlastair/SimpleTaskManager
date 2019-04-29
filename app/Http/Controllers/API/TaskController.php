<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Model\Task;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;

class TaskController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::orderBy('presentation_order', 'asc')->get();

        return $this->sendResponse($tasks->toArray(), 'Tasks retrieved successfully.');
    }

    /**
     * Store or update a resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        if (!is_null( $input['id'])) {
            $task = Task::find($input['id']);

            $validator = Validator::make($input, [
                'name' => [
                    'required',
                    Rule::unique('tasks')->ignore($input['id']),
                ],
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }

            $task->id = $input['id'];
            $task->name = $input['name'];
            $task->price = $input['price'];
            $task->deadline = $input['deadline'];
            $task->presentation_order = $input['presentation_order'];
            $task->done = $input['done'];
            $task->save();

            return $this->sendResponse($task->toArray(), 'Task updated successfully.');
        } else {
            $validator = Validator::make($input, [
                'name' => [
                    'required',
                    Rule::unique('tasks')
                ],
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }

            $lastTask = Task::orderBy('presentation_order', 'desc')->first();
            $input['presentation_order'] = $lastTask->presentation_order + 1;
            $task = Task::create($input);

            return $this->sendResponse($task->toArray(), 'Task created successfully.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::find($id);

        if (is_null($task)) {
            return $this->sendError('Task not found.');
        }

        return $this->sendResponse($task->toArray(), 'Task retrieved successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return $this->sendResponse($task->toArray(), 'Task deleted successfully.');
    }
}
