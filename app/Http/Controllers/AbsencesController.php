<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AbsencesController extends Controller
{
    // Get all absences
    public function index()
    {
        // Eager load the 'student' relationship
        $absences = Absence::with('student')->get();
        return response()->json(['absences' => $absences]);
    }

    // Get a single absence by ID
    public function show($id)
    {
        // Eager load the 'student' relationship
        $absence = Absence::with('student')->find($id);

        if (!$absence) {
            return response()->json(['message' => 'Absence not found'], 404);
        }

        return response()->json(['absence' => $absence]);
    }

    public function scanQrCode(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'qr_code' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Decode the QR code and find the student
        $decodedQrCode = base64_decode($request->qr_code);

        $student = User::where('nis', $decodedQrCode)->first();

        if (!$student) {
            return response()->json(['message' => 'Invalid QR code'], 400);
        }

        // Check if an absence already exists for the student today
        $existingAbsence = Absence::where('student_id', $student->id)
            ->whereDate('date', now()->toDateString())
            ->first();

        if ($existingAbsence) {
            return response()->json(['message' => 'Absence already recorded for today'], 409);
        }

        // Record the absence
        $absence = Absence::create([
            'student_id' => $student->id,
            'date' => now()->toDateString(),
            'status' => 'absent',
        ]);

        // Eager load the student relationship
        $absence->load('student');

        return response()->json(['message' => 'Absence recorded successfully', 'absence' => $absence], 201);
    }
}
