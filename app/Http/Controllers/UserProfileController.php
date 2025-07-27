<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $user = User::where('deleted_at', null)->get();

            return response()->json([
                'message'=> 'User Data Retrieved Successfully',
                'users' => $user
            ], 200);
        }catch (Exception $e) {
            return response()->json([
                'message' => 'Something went wrong!',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }
            
    
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
    
            return response()->json([
                'message' => 'User Created Successfully!',
                'name' => $request->name,
                'email'=>$request->email
            ], 201);
        }catch (Exception $e) {
            return response()->json([
                'message' => 'Something went wrong!',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try{
            $user = User::where('deleted_at', null)->find($id);

            if(!$user){
                return response()->json([
                    'message' => 'User Not Found!',
                ], 404);
            }

            return response()->json([
                'message' => 'User Data Retrieved Successfully!',
                'user' => $user,
            ], 200);
        }catch (Exception $e) {
            return response()->json([
                'message' => 'Something went wrong!',
                'error' => $e->getMessage()
            ], 500);
        }
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
        try {
            $user = User::where('deleted_at', null)->find($id);

            if (!$user) {
                return response()->json([
                    'message' => 'User not found!'
                ], 404);
            }

            $validator = Validator::make($request->all(), [
                'name' => 'sometimes|required|string|max:255',
                'email' => 'sometimes|required|email|max:255|unique:users,email,' . $id,
                'password' => 'sometimes|nullable|string|min:8',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $user->name = $request->name ?? $user->name;
            $user->email = $request->email ?? $user->email;
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }
            $user->save();

            return response()->json([
                'message' => 'User Data Updated Successfully!',
                'user' => $user
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Something went wrong!',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $user = User::find($id);
    
            if (!$user) {
                return response()->json([
                    'message' => 'User not found!'
                ], 404);
            }
    
            $user->delete(); // soft delete

            $softDeletedUser = User::onlyTrashed()->get();
    
            return response()->json([
                'message' => 'User Soft Deleted Successfully!',
                'Deleted Users' => $softDeletedUser
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Something went wrong!',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
