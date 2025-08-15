<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LeadController extends Controller
{
    /**
     * Menampilkan daftar calon customer (leads).
     */
    public function index()
    {
        $leads = Lead::orderBy('created_at', 'desc')->get();
        return view('leads.index', compact('leads'));
    }

    /**
     * Menampilkan form untuk membuat calon customer baru.
     */
    public function create()
    {
        return view('leads.create');
    }

    /**
     * Menyimpan calon customer baru ke database.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'nullable|email|unique:leads,email',
            'telepon' => 'nullable|string|max:255',
            'alamat' => 'nullable|string',
        ]);
        
        DB::beginTransaction();
        try {
            Lead::create($request->all());
            DB::commit();
            return redirect()->route('leads.index')->with('success', 'Calon customer berhasil ditambahkan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan data. ' . $e->getMessage());
        }
    }

    /**
     * Menampilkan form untuk mengedit calon customer.
     */
    public function edit(Lead $lead)
    {
        return view('leads.edit', compact('lead'));
    }

    /**
     * Memperbarui calon customer di database.
     */
    public function update(Request $request, Lead $lead)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'nullable|email|unique:leads,email,' . $lead->id, // validasi unique, kecuali data ini
            'telepon' => 'nullable|string|max:255',
            'alamat' => 'nullable|string',
        ]);
        
        DB::beginTransaction();
        try {
            $lead->update($request->all());
            DB::commit();
            return redirect()->route('leads.index')->with('success', 'Calon customer berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Terjadi kesalahan saat memperbarui data. ' . $e->getMessage());
        }
    }

    /**
     * Menghapus calon customer dari database.
     */
    public function destroy(Lead $lead)
    {
        DB::beginTransaction();
        try {
            $lead->delete();
            DB::commit();
            return redirect()->route('leads.index')->with('success', 'Calon customer berhasil dihapus!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan saat menghapus data. ' . $e->getMessage());
        }
    }
}
