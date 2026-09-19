<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = auth()->user();

        return view('user.profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:100'],

            'username' => [
                'required',
                'string',
                'max:50',
                Rule::unique('users', 'username')
                    ->ignore($user->id_user, 'id_user'),
            ],

            'email' => [
                'required',
                'email',
                'max:100',
                Rule::unique('users', 'email')
                    ->ignore($user->id_user, 'id_user'),
            ],

            'nomor_telepon' => ['nullable', 'string', 'max:20'],

            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        $user->nama = $validated['nama'];
        $user->username = $validated['username'];
        $user->email = $validated['email'];
        $user->nomor_telepon = $validated['nomor_telepon'] ?? null;

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()
            ->route('profile.edit')
            ->with('success', 'Profil berhasil diperbarui.');
    }
}