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
        $absences = Absence::all();
        return response()->json(['absences' => $absences]);
    }

    // Get a single absence by ID
    public function show($id)
    {
        $absence = Absence::find($id);

        if (!$absence) {
            return response()->json(['message' => 'Absence not found'], 404);
        }

        return response()->json(['absence' => $absence]);
    }

    //
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

        // Record the absence
        $absence = Absence::create([
            'student_id' => $student->id,
            'date' => now()->toDateString(),
            'status' => 'absent',
        ]);

        return response()->json(['message' => 'Absence recorded successfully', 'absence' => $absence], 201);
    }
}
