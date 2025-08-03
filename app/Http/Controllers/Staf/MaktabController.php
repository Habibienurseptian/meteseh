<?php

namespace App\Http\Controllers\Staf;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Maktab;
use App\Models\Booking;

class MaktabController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        if ($search) {
            $maktabs = Maktab::where('lokasi_rumah', 'like', '%' . $search . '%')
                             ->orWhere('nama_pemilik', 'like', '%' . $search . '%')
                             ->paginate(10);
        } else {
            $maktabs = Maktab::paginate(10);
        }
        
        return view('staf.maktab.index', compact('maktabs', 'search'));
    }

    public function create()
    {
        return view('staf.maktab.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'lokasi_rumah' => 'required|string|max:255',
            'nama_pemilik' => 'required|string|max:255',
            'nomor_telepon' => 'required|string|max:20',
        ]);

        Maktab::create($request->all());

        return redirect()->route('staf.maktab.index')->with('success', 'Maktab berhasil ditambahkan!');
    }

    public function show(string $id)
    {
        $maktab = Maktab::findOrFail($id);
        $booking = Booking::where('maktab_id', $id)->first();

        return view('staf.maktab.show', compact('maktab', 'booking'));
    }

    public function edit(Maktab $maktab)
    {
        return view('staf.maktab.edit', compact('maktab'));
    }

    public function update(Request $request, Maktab $maktab)
    {
        $request->validate([
            'lokasi_rumah' => 'required|string|max:255',
            'nama_pemilik' => 'required|string|max:255',
            'nomor_telepon' => 'required|string|max:20',
        ]);

        $maktab->update($request->all());

        return redirect()->route('staf.maktab.index')->with('success', 'Maktab berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $maktab = Maktab::findOrFail($id);
        $maktab->delete();
        return redirect()->route('staf.maktab.index')->with('success', 'Maktab and its related bookings deleted successfully!');
    }
}