<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Lead;
use App\Models\Customer;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Menampilkan dashboard dengan data ringkasan.
     */
    public function index()
    {
        // Ambil jumlah proyek berdasarkan status
        $totalProjects = Project::count();
        $pendingProjects = Lead::where('status', 'Baru')->count();
        $approvedProjects = Project::where('status', 'Approved')->count();
        $rejectedProjects = Project::where('status', 'Rejected')->count();

        // Hitung total pendapatan bulan berjalan
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        $monthlyRevenue = 0;
        $customers = Customer::whereBetween('created_at', [$startOfMonth, $endOfMonth])->get();
        foreach ($customers as $customer) {
            $monthlyRevenue += $customer->products->sum('harga');
        }

        return view('dashboard', compact(
            'totalProjects',
            'pendingProjects',
            'approvedProjects',
            'rejectedProjects',
            'monthlyRevenue'
        ));
    }
}
