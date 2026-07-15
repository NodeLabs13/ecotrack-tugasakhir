<?php

namespace App\Http\Controllers;

use App\Models\Proyek;
use App\Models\ProgresProyek;
use Illuminate\Http\Request;

class ProgresProyekController extends Controller
{
    public function create(Proyek $proyek)
    {
        return view('progres.create', compact('proyek'));
    }

    public function store(Request $request, Proyek $proyek)
    {
        $data = $request->validate([
            'tanggal_progres' => 'required|date',
            'uraian_pekerjaan' => 'required|string',
            'dokumentasi' => 'nullable|image|max:5120',
        ]);

        if ($request->hasFile('dokumentasi')) {
            $data['dokumentasi'] = $request->file('dokumentasi')->store('progres', 'public');
        }

        $data['proyek_id'] = $proyek->id;

        ProgresProyek::create($data);

        return redirect()->route('proyek.show', $proyek)->with('success', 'Progres proyek berhasil dicatat.');
    }
}
