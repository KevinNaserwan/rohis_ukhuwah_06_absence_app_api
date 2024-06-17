<?php

namespace App\Http\Controllers;

use App\Models\UserClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserClassesController extends Controller
{
    // Get all classes
    public function index()
    {
        $classes = UserClass::all();
        return response()->json(['classes' => $classes]);
    }

    // Get a single class by ID
    public function show($id)
    {
        $class = UserClass::find($id);

        if (!$class) {
            return response()->json(['message' => 'Class not found'], 404);
        }

        return response()->json(['class' => $class]);
    }

    // Create a new class
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $class = UserClass::create([
            'name' => $request->name,
        ]);

        return response()->json(['message' => 'Class created successfully', 'class' => $class], 201);
    }

    // Update a class
    public function update(Request $request, $id)
    {
        $class = UserClass::find($id);

        if (!$class) {
            return response()->json(['message' => 'Class not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $class->update([
            'name' => $request->name,
        ]);

        return response()->json(['message' => 'Class updated successfully', 'class' => $class]);
    }

    // Delete a class
    public function destroy($id)
    {
        $class = UserClass::find($id);

        if (!$class) {
            return response()->json(['message' => 'Class not found'], 404);
        }

        $class->delete();

        return response()->json(['message' => 'Class deleted successfully']);
    }
}
