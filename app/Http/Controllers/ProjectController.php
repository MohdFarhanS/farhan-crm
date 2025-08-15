<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Lead;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;


class ProjectController extends Controller
{
    /**
     * Menampilkan daftar proyek yang diajukan.
     * Manajer melihat semua proyek, sales hanya melihat proyeknya sendiri.
     */
    public function index()
    {
        if (Gate::allows('is-manager')) {
            $projects = Project::orderBy('created_at', 'desc')->get();
        } else {
            $projects = Project::where('user_id', auth()->id())->orderBy('created_at', 'desc')->get();
        }
        return view('projects.index', compact('projects'));
    }

    /**
     * Menampilkan form untuk membuat proyek dari lead tertentu.
     */
    public function create(Lead $lead)
    {
        $products = Product::where('is_active', true)->get();
        return view('projects.create', compact('lead', 'products'));
    }

    /**
     * Menyimpan proyek baru ke database.
     */
    public function store(Request $request, Lead $lead)
    {
        DB::beginTransaction();
        try {
            Project::create([
                'lead_id' => $lead->id,
                'user_id' => auth()->id(),
                'status' => 'Pending',
            ]);
            
            $lead->status = 'Diproses';
            $lead->save();
            
            DB::commit();
            return redirect()->route('projects.index')->with('success', 'Proyek berhasil dibuat dan menunggu persetujuan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan saat membuat proyek. ' . $e->getMessage());
        }
    }

    /**
     * Menyetujui proyek.
     */
    public function approve(Project $project)
    {
        DB::beginTransaction();
        try {
            $project->status = 'Approved';
            $project->save();

            $project->lead->status = 'Disetujui';
            $project->lead->save();

            $lead = $project->lead;

            $customer = Customer::create([
                'nama' => $lead->nama,
                'email' => $lead->email,
                'telepon' => $lead->telepon,
                'alamat' => $lead->alamat,
            ]);

            DB::commit();
            return redirect()->route('projects.index')->with('success', 'Proyek berhasil disetujui!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan saat menyetujui proyek. ' . $e->getMessage());
        }
    }

    /**
     * Menolak proyek.
     */
    public function reject(Project $project)
    {
        DB::beginTransaction();
        try {
            $project->status = 'Rejected';
            $project->save();
            
            $project->lead->status = 'Ditolak';
            $project->lead->save();
            
            DB::commit();
            return redirect()->route('projects.index')->with('success', 'Proyek berhasil ditolak!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan saat menolak proyek. ' . $e->getMessage());
        }
    }
}
