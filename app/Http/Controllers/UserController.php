<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function update(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'gender' => 'required',
            'alamat' => 'required|string|max:255',
        ]);

        // Simpan sementara ke session (karena belum pakai database user lengkap)
        $user = session('user');
        $user['name'] = $validated['name'];
        $user['gender'] = $validated['gender'];
        $user['alamat'] = $validated['alamat'];

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('profile_images', 'public');
            $user['image'] = $imagePath;
        }

        session(['user' => $user]);

        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }
}

