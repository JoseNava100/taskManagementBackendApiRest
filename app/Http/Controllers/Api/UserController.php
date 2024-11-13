<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::all();

        if ($user->isEmpty()) {
            
            $message = [
                'message' => 'Do not have users, plase register one new',
                'status' => 404
            ];

            return response()->json($message, 400);

        } else {
            
            return response()->json($user, 200);
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
            'username' => 'required|string|max:30',
            'first_name' => 'required|string|max:25',
            'last_name' => 'required|string|max:25',
            'email' => 'required|email|max:255',
            'email_verified_at' => 'nullable|date',
            'password' => 'required|string|min:8|max:20|confirmed',
            'role_id' => 'required|integer|min:1'
        ]);

        if ($validation->fails()) {
            
            $message = [
                'message' => 'Error in data validations',
                'error' => $validation->errors(),
                'status' => 400
            ];

            return response()->json($message, 400);

        } else {

            $role = Role::find($request->role_id);

            if (!$role) {

                $message = [
                    'message' => 'Role not found',
                    'user' => $request->role_id,
                    'status' => 404
                ];
                
                return response()->json($message, 404);

            } else {

                if (User::where('username', $request->username)->exists() && 
                    User::where('first_name', $request->first_name)->exists() &&
                    User::where('last_name', $request->last_name)->exists() &&
                    User::where('email', $request->email)->exists() &&
                    User::where('role_id', $request->role_id)->exists()) {
                
                    $message = [
                        'message' => 'The dates already exists, please enter a new one',
                        'status' => 400
                    ];
    
                    return response()->json($message, 400);
    
                } else {
                    
                    $role = User::create($request->only([
                        'username', 
                        'first_name', 
                        'last_name', 
                        'email', 
                        'email_verified_at', 
                        'password', 
                        'role_id'
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
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
