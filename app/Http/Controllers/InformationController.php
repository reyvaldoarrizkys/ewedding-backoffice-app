<?php

namespace App\Http\Controllers;

use App\Models\Information;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class InformationController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('role:Admin', except: ['index', 'show']),
        ];
    }

    public function index()
    {
        $information = Information::latest()->paginate(10);
        return view('information.index', compact('information'));
    }

    public function create()
    {
        return view('information.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tipe_info' => 'required|string|max:50',
            'judul' => 'required|string|max:150',
            'konten_teks' => 'nullable|string',
            'url_media' => 'nullable|url|max:255',
        ]);

        Information::create($validated);

        return redirect()->route('information.index')->with('success', 'Informasi/Pengumuman berhasil ditambahkan.');
    }

    public function show(Information $information)
    {
        return view('information.show', compact('information'));
    }

    public function edit(Information $information)
    {
        return view('information.edit', compact('information'));
    }

    public function update(Request $request, Information $information)
    {
        $validated = $request->validate([
            'tipe_info' => 'required|string|max:50',
            'judul' => 'required|string|max:150',
            'konten_teks' => 'nullable|string',
            'url_media' => 'nullable|url|max:255',
        ]);

        $information->update($validated);

        return redirect()->route('information.index')->with('success', 'Informasi/Pengumuman berhasil diperbarui.');
    }

    public function destroy(Information $information)
    {
        $information->delete();
        return redirect()->route('information.index')->with('success', 'Informasi/Pengumuman berhasil dihapus.');
    }
}
