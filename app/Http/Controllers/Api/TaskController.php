<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $task = Task::all();

        if ($task->isEmpty()) {
            
            $message = [
                'message' => 'Do not have task',
                'status' => 404
            ];

            return response()->json($message, 404);

        } else {
            
            return response()->json($task, 200);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'title' => 'required|string|max:50',
            'sub_title' => 'required|string|max:50',
            'description' => 'required|string|max:100',
            'due_date' => 'required|date|after_or_equal:today|date_format:Y-m-d',
            'status' => 'required|string|in:pending,in_progress,completed',
            'priority' => 'required|string|in:low,medium,high',
            'user_id' => 'required|integer'
        ]);

        if ($validation->fails()) {
            
            $message = [
                'message' => 'Error in data validations',
                'error' => $validation->errors(),
                'status' => 400
            ];

            return response()->json($message, 400);

        } else {

            $user = User::find($request->user_id);

            if (!$user) {

                $message = [
                    'message' => 'User not found',
                    'user' => $request->user_id,
                    'status' => 404
                ];
                
                return response()->json($message, 404);

            } else {

                $task = Task::create($request->only([
                    'title', 
                    'sub_title', 
                    'description', 
                    'due_date', 
                    'status', 
                    'priority', 
                    'user_id'
                ]));
    
                if (!$task) {
    
                    $message = [
                        'message' => 'Error creating task',
                        'status' => 500
                    ];
    
                    return response()->json($message, 500);
    
                } else {
                    
                    return response()->json($task, 201);
    
                }
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task = Task::find($id);

        if (!$task) {
            
            $message = [
                'message' => 'Task not found',
                'status' => 404
            ];
            
            return response()->json($message, 404);
            
        } else {

            return response()->json($task, 200);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $id)
    {
        $task = Task::find($id);

        if (!$task) {
            
            $message = [
                'message' => 'Task not found',
                'status' => 404
            ];

            return response()->json($message, 404);

        } else {

            $validation = Validator::make($request->all(), [
                'title' => 'string|max:50',
                'sub_title' => 'string|max:50',
                'description' => 'string|max:100',
                'due_date' => 'date|after_or_equal:today|date_format:Y-m-d',
                'status' => 'string|in:pending,in_progress,completed',
                'priority' => 'string|in:low,medium,high',
                'user_id' => 'integer'
            ]);

            if ($validation->fails()) {
                
                $message = [
                    'message' => 'Error in data validations',
                    'errors' => $validation->errors(),
                    'status' => 400
                ];

                return response()->json($message, 400);

            } else {
                
                $task->fill($request->only([
                    'title', 
                    'sub_title', 
                    'description', 
                    'due_date', 
                    'status', 
                    'priority', 
                    'user_id'
                ]))->save();

                $message = [
                    'message' => 'Update task',
                    'character' => $task,
                    'status' => 200
                ];

                return response()->json($message, 200);
            }
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $task = Task::find($id);

        if (!$task) {
            
            $message = [
                'message' => 'Task not found',
                'status' => 404
            ];

            return response()->json($message, 404);

        } else {
            
            $validation = Validator::make($request->all(), [
                'title' => 'required|string|max:50',
                'sub_title' => 'required|string|max:50',
                'description' => 'required|string|max:100',
                'due_date' => 'required|date|after_or_equal:today|date_format:Y-m-d',
                'status' => 'required|string|in:pending,in_progress,completed',
                'priority' => 'required|string|in:low,medium,high',
                'user_id' => 'required|integer'
            ]);

            if ($validation->fails()) {
                
                $message = [
                    'message' => 'Error in data validations',
                    'errors' => $validation->errors(),
                    'status' => 400
                ];

                return response()->json($message, 400);

            } else {
                
                $task-> update($request->only([
                    'title', 
                    'sub_title', 
                    'description', 
                    'due_date', 
                    'status', 
                    'priority', 
                    'user_id'
                ]));

                return response()->json($task, 200);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Task::find($id);

        if (!$task) {
            
            $message = [
                'message' => 'Task not found',
                'status' => 404
            ];

            return response()->json($message, 404);

        } else {
            
            $task->delete();

            $message = [
                'message' => 'Delete task',
                'status' => 200
            ];

            return response()->json($message, 200);
        }
    }
}
