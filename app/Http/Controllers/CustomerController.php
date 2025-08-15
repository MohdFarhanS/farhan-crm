<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::orderBy('created_at', 'desc')->get();
        return view('customers.index', compact('customers'));
    }

    public function show(Customer $customer)
    {
        $availableProducts = Product::where('is_active', true)->get();
        return view('customers.show', compact('customer', 'availableProducts'));
    }

    public function addProduct(Request $request, Customer $customer)
    {
        // Pastikan hanya sales yang bisa melakukan aksi ini
        if (!Gate::allows('is-sales')) {
            return back()->with('error', 'Anda tidak memiliki hak akses.');
        }

        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        DB::beginTransaction();
        try {
            // Hubungkan produk dengan customer
            $customer->products()->attach($request->product_id);
            DB::commit();
            return back()->with('success', 'Layanan berhasil ditambahkan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan saat menambahkan layanan. ' . $e->getMessage());
        }
    }
}
