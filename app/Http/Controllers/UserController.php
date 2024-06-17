<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Controller; // Ensure the base controller is imported if necessary
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class UserController extends Controller
{

    // Register a new user
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'nis' => 'required|integer',
            'class_id' => 'required|integer|exists:classes,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Generate QR code
        $encode = base64_encode($request->nis);
        // Create user with QR code
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'nis' => $request->nis,
            'role' => 'siswa',  // Set default role to "siswa"
            'class_id' => $request->class_id,
            'qr_code' => $encode,  // Store base64 encoded QR code
        ]);

        return response()->json(['message' => 'User registered successfully', 'user' => $user], 201);
    }

    // Login a user
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['message' => 'Login successful', 'token' => $token, 'user' => $user]);
    }

    // Show a single user by ID
    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json(['user' => $user]);
    }

    // Show all users
    public function index()
    {
        $users = User::all();

        if (!$users) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json(['users' => $users]);
    }

    // Delete a user by ID
    public function delete($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }
}
