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

        $query = Maktab::query();

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('lokasi_rumah', 'like', '%' . $search . '%')
                ->orWhere('nama_pemilik', 'like', '%' . $search . '%')
                ->orWhere('nomor_telepon', 'like', '%' . $search . '%')
                ->orWhere('kapasitas_penghuni', 'like', '%' . $search . '%')
                ->orWhere('sisa_kapasitas', 'like', '%' . $search . '%')
                ->paginate(10);

            });
        }

        // Ambil data maktab dengan booking terhubung
        $maktabs = $query->with('bookings')->paginate(10);

        // Hitung sisa kapasitas untuk masing-masing maktab
        foreach ($maktabs as $maktab) {
            $total_jamaah = $maktab->bookings->sum('number_of_pilgrims');
            $maktab->sisa_kapasitas = max(0, $maktab->kapasitas_penghuni - $total_jamaah);
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
            'kapasitas_penghuni' => 'required|integer|min:1',
        ]);

        Maktab::create($request->only([
            'lokasi_rumah',
            'nama_pemilik',
            'nomor_telepon',
            'kapasitas_penghuni',
        ]));

        return redirect()->route('staf.maktab.index')->with('success', 'Maktab berhasil ditambahkan!');
    }

    public function show(string $id)
    {
        $maktab = Maktab::findOrFail($id);
        $bookings = Booking::where('maktab_id', $id)->first();
        $total_jamaah = $maktab->bookings()->sum('number_of_pilgrims');
        $sisa_kapasitas = max(0, $maktab->kapasitas_penghuni - $total_jamaah);

        return view('staf.maktab.show', compact('maktab', 'bookings', 'total_jamaah', 'sisa_kapasitas'));
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
            'kapasitas_penghuni' => 'required|integer|min:1',
        ]);

        $maktab->update($request->only([
            'lokasi_rumah',
            'nama_pemilik',
            'nomor_telepon',
            'kapasitas_penghuni',
        ]));

        return redirect()->route('staf.maktab.index')->with('success', 'Maktab berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $maktab = Maktab::findOrFail($id);
        $maktab->delete();
        return redirect()->route('staf.maktab.index')->with('success', 'Maktab and its related bookings deleted successfully!');
    }
}