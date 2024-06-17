<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

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

    // Generate QR code for a user (Only for students)
    public function generateQrCode(Request $request)
    {
        $user = $request->user();

        if ($user->role !== 'siswa') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $qrCode = QrCode::size(300)->generate($user->nis);
        return response()->json(['qr_code' => base64_encode($qrCode)], 200);
    }

    // Scan QR code and record absence (Only for admin)
    public function scanQrCode(Request $request)
    {
        $user = $request->user();

        if ($user->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $validator = Validator::make($request->all(), [
            'qr_code' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $nis = base64_decode($request->qr_code);
        $student = User::where('nis', $nis)->first();

        if (!$student) {
            return response()->json(['message' => 'Invalid QR code'], 400);
        }

        $absence = Absence::create([
            'student_id' => $student->id,
            'date' => now()->toDateString(),
            'status' => 'absent',
        ]);

        return response()->json(['message' => 'Absence recorded successfully', 'absence' => $absence], 201);
    }
}
