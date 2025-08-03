<?php

namespace App\Http\Controllers\Staf;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Maktab;
use Carbon\Carbon;

class BookingController extends Controller
{
    /**
     * Menampilkan daftar semua bookings.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        $statusFilter = $request->query('status_filter');
        $query = Booking::query();
        if ($search) {
            $query->where('group_name', 'like', '%' . $search . '%')
                  ->orWhere('leader_name', 'like', '%' . $search . '%')
                  ->orWhere('region', 'like', '%' . $search . '%')
                  ->orWhere('group_address', 'like', '%' . $search . '%')
                  ->orWhere('booking_code', 'like', '%' . $search . '%')
                  ->paginate(10);

        }
        if ($statusFilter && in_array($statusFilter, ['confirmed', 'pending', 'cancelled'])) {
            $query->where('status', $statusFilter);
        }
        $bookings = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('staf.bookings.index', compact('bookings'));
    }

    /**
     * Menampilkan formulir untuk membuat booking baru.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $regions = [
            'Aceh', 'Sumatera Utara', 'Sumatera Barat', 'Riau', 'Kepulauan Riau',
            'Jambi', 'Bengkulu', 'Sumatera Selatan', 'Kepulauan Bangka Belitung', 'Lampung',
            'DKI Jakarta', 'Jawa Barat', 'Banten', 'Jawa Tengah', 'DI Yogyakarta', 'Jawa Timur',
            'Bali', 'Nusa Tenggara Barat', 'Nusa Tenggara Timur',
            'Kalimantan Barat', 'Kalimantan Tengah', 'Kalimantan Selatan', 'Kalimantan Timur', 'Kalimantan Utara',
            'Sulawesi Utara', 'Gorontalo', 'Sulawesi Tengah', 'Sulawesi Barat', 'Sulawesi Selatan', 'Sulawesi Tenggara',
            'Maluku', 'Maluku Utara',
            'Papua', 'Papua Barat', 'Papua Tengah', 'Papua Pegunungan', 'Papua Selatan', 'Papua Barat Daya'
        ];
        $vehicleTypes = ['Bus Besar', 'Minibus', 'Van', 'Mobil Pribadi', 'Kereta Api', 'Pesawat', 'Lainnya'];
        // $statuses = ['confirmed', 'pending', 'cancelled'];
        // $pickup_statuses = ['Sudah Dijemput', 'Menunggu Penjemputan', 'Dibatalkan'];
        // $maktabs = Maktab::all();

        // Pastikan $vehicleTypes dilewatkan ke view
        return view('staf.bookings.create', compact('regions', 'vehicleTypes'));
    }

    /**
     * Menyimpan booking baru ke database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'region' => 'required|string|max:255',
            'group_name' => 'required|string|max:255',
            'group_address' => 'required|string|max:255',
            'leader_name' => 'required|string|max:255',
            'number_of_pilgrims' => 'required|integer|min:1',
            'arrival_time' => 'required|date',
            'vehicle_type' => 'nullable|string|max:255',
            'number_of_vehicles' => 'nullable|integer|min:0',
            'contact_number' => 'nullable|string|max:20',
            'departure_time' => 'nullable|date|after_or_equal:arrival_time',
            'notes' => 'nullable|string',
        ]);

        // Hitung jumlah booking untuk generate kode
        $count = Booking::count() + 1;
        $code = 'MKTB-' . str_pad($count, 4, '0', STR_PAD_LEFT);
        $token = Str::random(32);

        $booking = Booking::create([
            'booking_code' => $code,
            'edit_token' => $token,
            'region' => $request->region,
            'group_name' => $request->group_name,
            'group_address' => $request->group_address,
            'leader_name' => $request->leader_name,
            'number_of_pilgrims' => $request->number_of_pilgrims,
            'arrival_time' => Carbon::parse($request->arrival_time),
            'vehicle_type' => $request->vehicle_type,
            'number_of_vehicles' => $request->number_of_vehicles,
            'contact_number' => $request->contact_number,
            'departure_time' => $request->departure_time ? Carbon::parse($request->departure_time) : null,
            'notes' => $request->notes,
            'status' => 'pending', // default status
        ]);

        return redirect()->route('staf.bookings.index')->with('success', 'Booking berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail booking tertentu.
     *
     * @param  string  $id
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function show(string $id)
    {
        $booking = Booking::with('maktab')->findOrFail($id);
        return view('staf.bookings.show', compact('booking'));
    }

    /**
     * Menampilkan formulir untuk mengedit booking tertentu.
     *
     * @param  string  $id
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit(string $id)
    {
        $booking = Booking::findOrFail($id);

        $regions = [
            'Aceh', 'Sumatera Utara', 'Sumatera Barat', 'Riau', 'Kepulauan Riau',
            'Jambi', 'Bengkulu', 'Sumatera Selatan', 'Kepulauan Bangka Belitung', 'Lampung',
            'DKI Jakarta', 'Jawa Barat', 'Banten', 'Jawa Tengah', 'DI Yogyakarta', 'Jawa Timur',
            'Bali', 'Nusa Tenggara Barat', 'Nusa Tenggara Timur',
            'Kalimantan Barat', 'Kalimantan Tengah', 'Kalimantan Selatan', 'Kalimantan Timur', 'Kalimantan Utara',
            'Sulawesi Utara', 'Gorontalo', 'Sulawesi Tengah', 'Sulawesi Barat', 'Sulawesi Selatan', 'Sulawesi Tenggara',
            'Maluku', 'Maluku Utara',
            'Papua', 'Papua Barat', 'Papua Tengah', 'Papua Pegunungan', 'Papua Selatan', 'Papua Barat Daya'
        ];

        $vehicleTypes = ['Bus Besar', 'Minibus', 'Van', 'Mobil Pribadi', 'Kereta Api', 'Pesawat', 'Lainnya'];
        $statuses = ['confirmed', 'pending', 'cancelled'];
        $pickup_statuses = ['Sudah Dijemput', 'Menunggu Penjemputan', 'Dibatalkan'];

        $maktabs = Maktab::with('bookings')->get();

        foreach ($maktabs as $maktab) {
            $total_jamaah = $maktab->bookings->sum('number_of_pilgrims');
            $maktab->sisa_kapasitas = max(0, $maktab->kapasitas_penghuni - $total_jamaah);
        }

        return view('staf.bookings.edit', compact(
            'booking',
            'regions',
            'vehicleTypes',
            'statuses',
            'pickup_statuses',
            'maktabs'
        ));
    }


    /**
     * Memperbarui booking tertentu di database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'region' => 'required|string|max:255',
            'group_name' => 'required|string|max:255',
            'group_address' => 'required|string|max:255',
            'leader_name' => 'required|string|max:255',
            'number_of_pilgrims' => 'required|integer|min:1',
            'arrival_time' => 'required|date',
            'status' => 'required|string|in:confirmed,pending,cancelled',
            'pickup_status' => 'required|string|in:Sudah Dijemput,Menunggu Penjemputan,Dibatalkan',
            'vehicle_type' => 'nullable|string|max:255',
            'number_of_vehicles' => 'nullable|integer|min:0',
            'contact_number' => 'nullable|string|max:20',
            'departure_time' => 'nullable|date|after_or_equal:arrival_time',
            'notes' => 'nullable|string',
            'maktab_id' => function ($attribute, $value, $fail) use ($request) {
                // Jika status 'confirmed', maktab_id wajib
                if ($request->status === 'confirmed' && empty($value)) {
                    $fail('Maktab harus dipilih jika status dikonfirmasi.');
                }

                // Jika maktab_id diisi, status harus 'confirmed'
                if (!empty($value) && $request->status !== 'confirmed') {
                    $fail('Status harus dikonfirmasi jika maktab dipilih.');
                }
            },
        ]);

        // Mengubah $bookings menjadi $booking
        $booking = Booking::findOrFail($id);
        $booking->update([
            'region' => $request->region,
            'group_name' => $request->group_name,
            'group_address' => $request->group_address,
            'leader_name' => $request->leader_name,
            'number_of_pilgrims' => $request->number_of_pilgrims,
            'arrival_time' => Carbon::parse($request->arrival_time),
            'status' => $request->status,
            'pickup_status' => $request->pickup_status,
            'vehicle_type' => $request->vehicle_type,
            'number_of_vehicles' => $request->number_of_vehicles,
            'contact_number' => $request->contact_number,
            'departure_time' => $request->departure_time ? Carbon::parse($request->departure_time) : null,
            'notes' => $request->notes,
            'maktab_id' => $request->maktab_id,
        ]);

        return redirect()->route('staf.bookings.index')->with('success', 'Booking berhasil diperbarui!');
    }

    /**
     * Menghapus booking tertentu dari database.
     *
     * @param  string  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $id)
    {
        // Mengubah $bookings menjadi $booking
        $booking = Booking::findOrFail($id);
        $booking->delete();
        return redirect()->route('staf.bookings.index')->with('success', 'Booking berhasil dihapus!');
    }
}
