<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $role = Role::all();

        if ($role->isEmpty()) {
            
            $message = [
                'message' => 'Do not have roles',
                'status' => 404
            ];

            return response()->json($message, 404);

        } else {
            
            return response()->json($role, 200);

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
            'name' => 'required|string|max:30',
            'description' => 'string|max:60'
        ]);

        if ($validation->fails()) {
            
            $message = [
                'message' => 'Error in data validation',
                'error' => $validation->errors(),
                'status' => 400
            ];

            return response()->json($message, 400);

        } else {

            if (Role::where('name', $request->name)->exists() && Role::where('description', $request->description)->exists()) {
                
                $message = [
                    'message' => 'The name already exists, please enter a new one',
                    'status' => 400
                ];

                return response()->json($message, 400);

            } else {

                $role = Role::create($request->only([
                    'name',
                    'description'
                ]));
    
                if (!$role) {
                    
                    $message = [
                        'message' => 'Error creating role',
                        'status' => 500
                    ];
    
                    return response()->json($message, 500);
    
                } else {
    
                    return response()->json($role, 201);
    
                }
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $role = Role::find($id);

        if (!$role) {
            
            $message = [
                'message' => 'Role not found',
                'status' => 400
            ];

            return response()->json($message, 400);

        } else {
            
            return response()->json($role, 200);

        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $id)
    {
        $role = Role::find($id);

        if (!$role) {
            
            $message = [
                'message' => 'Role not found',
                'status' => 404
            ];

            return response()->json($message, 404);

        } else {

            $validation = Validator::make($request->all(), [
                'name' => 'string|max:30',
                'description' => 'string|max:60'
            ]);

            if ($validation->fails()) {
                
                $message = [
                    'message' => 'Error in data validations',
                    'errors' => $validation->errors(),
                    'status' => 400
                ];

                return response()->json($message, 400);

            } else {

                if (Role::where('name', $request->name)->exists() && Role::where('description', $request->description)->exists()){

                    $message = [
                        'message' => 'The dates already exists, please enter a new one',
                        'status' => 400
                    ];
    
                    return response()->json($message, 400);

                } else {
                    
                    $role->fill($request->only([
                        'name', 
                        'description'
                    ]))->save();
    
                    $message = [
                        'message' => 'Update role',
                        'character' => $role,
                        'status' => 200
                    ];
    
                    return response()->json($message, 200);
                    
                }
            }
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $role = Role::find($id);

        if (!$role) {
            
            $message = [
                'message' => 'Role not found',
                'status' => 404
            ];

            return response()->json($message, 404);

        } else {
            
            $validation = Validator::make($request->all(), [
                'name' => 'required|string|max:30',
                'description' => 'string|max:60'
            ]);

            if ($validation->fails()) {
                
                $message = [
                    'message' => 'Error in data validations',
                    'errors' => $validation->errors(),
                    'status' => 400
                ];

                return response()->json($message, 400);

            } else {

                if (Role::where('name', $request->name)->exists() && Role::where('description', $request->description)->exists()){

                    $message = [
                        'message' => 'The dates already exists, please enter a new one',
                        'status' => 400
                    ];
    
                    return response()->json($message, 400);

                } else {
                    
                    $role-> update($request->only([
                        'name', 
                        'description'
                    ]));
    
                    return response()->json($role, 200);
                    
                }
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::find($id);

        if (!$role) {
            
            $message = [
                'message' => 'Role not found',
                'status' => 404
            ];

            return response()->json($message, 404);

        } else {
            
            $role->delete();

            $message = [
                'message' => 'Delete role',
                'status' => 200
            ];

            return response()->json($message, 200);
        }
    }
}
