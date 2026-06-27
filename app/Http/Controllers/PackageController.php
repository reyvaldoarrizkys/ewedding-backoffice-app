<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class PackageController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('role:Admin', except: ['index', 'show']),
        ];
    }

    public function index()
    {
        $packages = Package::latest()->paginate(10);
        return view('packages.index', compact('packages'));
    }

    public function create()
    {
        return view('packages.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_paket' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
            'status_aktif' => 'required|in:Aktif,Nonaktif',
        ]);

        Package::create($validated);

        return redirect()->route('packages.index')->with('success', 'Paket berhasil ditambahkan.');
    }

    public function show(Package $package)
    {
        return view('packages.show', compact('package'));
    }

    public function edit(Package $package)
    {
        return view('packages.edit', compact('package'));
    }

    public function update(Request $request, Package $package)
    {
        $validated = $request->validate([
            'nama_paket' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
            'status_aktif' => 'required|in:Aktif,Nonaktif',
        ]);

        $package->update($validated);

        return redirect()->route('packages.index')->with('success', 'Paket berhasil diperbarui.');
    }

    public function destroy(Package $package)
    {
        // Add check if package is used in orders
        if ($package->orders()->exists()) {
            return redirect()->route('packages.index')->with('error', 'Paket tidak dapat dihapus karena sedang digunakan dalam pesanan.');
        }

        $package->delete();
        return redirect()->route('packages.index')->with('success', 'Paket berhasil dihapus.');
    }
}
