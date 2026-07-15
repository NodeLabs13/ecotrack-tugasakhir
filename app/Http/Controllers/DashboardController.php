<?php

namespace App\Http\Controllers;

use App\Models\Proyek;
use App\Models\Klien;
use App\Models\DokumenProyek;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->isKlien()) {
            $proyeks = Proyek::where('klien_id', $user->klien_id)->get();
            return view('dashboard', [
                'totalProyek' => $proyeks->count(),
                'proyekBerjalan' => $proyeks->where('status_proyek', 'berjalan')->count(),
                'proyekSelesai' => $proyeks->where('status_proyek', 'selesai')->count(),
                'proyekList' => $proyeks,
                'totalKlien' => null,
                'totalDokumen' => DokumenProyek::whereIn('proyek_id', $proyeks->pluck('id'))->count(),
            ]);
        }

        $query = Proyek::with('klien');

        // Filter by assigned_to for civil_engineer & perizinan_lingkungan
        if (in_array($user->role, ['civil_engineer', 'perizinan_lingkungan'])) {
            $query->where(function ($q) use ($user) {
                $q->whereNull('assigned_to')
                  ->orWhere('assigned_to', '[]')
                  ->orWhereJsonContains('assigned_to', $user->role);
            });
        }

        $proyeks = $query->latest()->get();

        // Count clients based on the same filter
        $totalKlien = null;
        if (in_array($user->role, ['civil_engineer', 'perizinan_lingkungan'])) {
            $klienIds = $proyeks->pluck('klien_id')->unique()->filter();
            $totalKlien = \App\Models\Klien::whereIn('id', $klienIds)->count();
        } else {
            $totalKlien = Klien::count();
        }

        return view('dashboard', [
            'totalProyek' => $proyeks->count(),
            'proyekBerjalan' => $proyeks->where('status_proyek', 'berjalan')->count(),
            'proyekSelesai' => $proyeks->where('status_proyek', 'selesai')->count(),
            'proyekList' => $proyeks->take(10),
            'totalKlien' => $totalKlien,
            'totalDokumen' => DokumenProyek::count(),
        ]);
    }
}
