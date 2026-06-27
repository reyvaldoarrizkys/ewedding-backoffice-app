<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    /**
     * Show the landing page with active packages.
     */
    public function index()
    {
        // Only get packages that are active
        $packages = Package::where('status_aktif', 'Aktif')->get();
        
        return view('landing', compact('packages'));
    }
}
