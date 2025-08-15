<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Menampilkan form untuk mengubah role pengguna.
     */
    public function showChangeRoleForm()
    {
        // Hanya manajer yang bisa mengakses halaman ini
        if (Gate::allows('is-manager')) {
            $users = User::all();
            return view('users.change-role', compact('users'));
        }

        return redirect()->back()->with('error', 'Anda tidak memiliki hak akses.');
    }

    /**
     * Memperbarui role pengguna.
     */
    public function changeRole(Request $request)
    {
        // Hanya manajer yang bisa melakukan aksi ini
        if (! Gate::allows('is-manager')) {
            return redirect()->back()->with('error', 'Anda tidak memiliki hak akses.');
        }

        $request->validate([
            'email' => 'required|email|exists:users,email',
            'role' => 'required|string|in:sales,manager',
        ]);

        DB::beginTransaction();
        try {
            $user = User::where('email', $request->email)->firstOrFail();
            $user->role = $request->role;
            $user->save();

            DB::commit();
            return redirect()->back()->with('success', 'Role pengguna berhasil diubah!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan saat mengubah role: ' . $e->getMessage());
        }
    }
}
