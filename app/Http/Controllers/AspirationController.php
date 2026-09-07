<?php

namespace App\Http\Controllers;

use App\Models\Aspiration;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AspirationController extends Controller
{
    /**
     * Menyimpan Aspirasi Baru dari Publik (Tanpa Login)
     */
    public function store(Request $request)
    {
        // Validasi Input Form
        $validated = $request->validate([
            'sender_name' => 'nullable|string|max:100',
            'email'       => 'nullable|email|max:150',
            'category'    => 'required|string|max:50',
            'message'     => 'required|string|min:10|max:2000',
        ]);

        // Generate Kode Tracking Unik (Contoh: ASP-8X9A2B1C)
        $validated['tracking_code'] = 'ASP-' . strtoupper(Str::random(8));

        // Sanitasi Input dari Potensi Serangan XSS
        $validated['sender_name'] = $validated['sender_name'] ? strip_tags($validated['sender_name']) : 'Anonim';
        $validated['email']       = $validated['email'] ? strip_tags($validated['email']) : null;
        $validated['category']    = strip_tags($validated['category']);
        $validated['message']     = strip_tags($validated['message']);

        // Simpan ke Database
        $aspiration = Aspiration::create($validated);

        // Redirect kembali dengan membawa kode tracking sukses
        return back()->with('success_code', $aspiration->tracking_code);
    }

    /**
     * Memeriksa Status & Progress Aspirasi berdasarkan Kode Tracking
     */
    public function check(Request $request)
    {
        $code = trim($request->input('tracking_code'));

        // Cari data aspirasi berdasarkan kode tracking
        $aspiration = Aspiration::where('tracking_code', $code)->first();

        if (! $aspiration) {
            return back()->with('error', 'Kode tracking tidak ditemukan! Periksa kembali kode Anda.');
        }

        // Kembalikan hasil pencarian ke halaman aspirasi via session
        return back()->with('aspiration_result', $aspiration);
    }
}
