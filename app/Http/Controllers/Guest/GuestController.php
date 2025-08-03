<?php

namespace App\Http\Controllers\Guest;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Maktab;
use Carbon\Carbon;


class GuestController extends Controller
{
    /**
     * Menampilkan halaman tamu.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $search = $request->query('search'); 
        $query = Booking::query();
        if ($search) {
            $query->where('group_name', 'like', '%' . $search . '%')
                  ->orWhere('leader_name', 'like', '%' . $search . '%')
                  ->orWhere('region', 'like', '%' . $search . '%')
                  ->orWhere('group_address', 'like', '%' . $search . '%')
                  ->orWhere('booking_code', 'like', '%' . $search . '%')
                  ->paginate(10);

        }

        $recentBookings = $query->orderBy('created_at', 'desc')->paginate(10);
        $totalBookings = Booking::count();
        $totalOrang = Booking::sum('number_of_pilgrims');
        $totalKendaraan = Booking::sum('number_of_vehicles');
        $totalMaktab = Maktab::count();


        return view('tamu.index', compact('totalBookings', 'totalOrang', 'totalKendaraan', 'totalMaktab', 'recentBookings'));
    }

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

        return view('tamu.bookings.create', compact('regions', 'vehicleTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'region' => 'required|string|max:255',
            'group_name' => 'required|string|max:255',
            'group_address' => 'required|string|max:255',
            'leader_name' => 'required|string|max:255',
            'number_of_pilgrims' => 'required|integer|min:1',
            'arrival_time' => 'required|date',
            'vehicle_type' => 'required|string|max:255',
            'number_of_vehicles' => 'required|integer|min:0',
            'contact_number' => 'required|string|max:20',
            'departure_time' => 'required|date|after_or_equal:arrival_time',
            'notes' => 'nullable|string',
        ]);

        // Hitung jumlah booking untuk generate kode
        $count = Booking::count() + 1;
        $code = 'MKTB-' . str_pad($count, 4, '0', STR_PAD_LEFT);
        

        $booking = Booking::create([
            'booking_code' => $code,
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
        ]);
        return redirect()->route('tamu.bookings.show', $booking->id)
        ->with('success', 'Booking berhasil disimpan.')
        ->with('edit_link', route('tamu.bookings.edit', [
            'booking_code' => $code,
        ]));
    }

    public function show(string $id)
    {
        $booking = Booking::with('maktab')->findOrFail($id);
        $maktab = $booking->maktab;
        return view('tamu.bookings.show', compact('booking', 'maktab'));
    }

    public function edit($booking_code)
    {
       $booking = Booking::where('booking_code', $booking_code)
                      ->firstOrFail();

        return view('tamu.bookings.edit', compact('booking'));
    }

    public function update(Request $request, $booking_code)
    {
        $booking = Booking::where('booking_code', $booking_code)
                        ->firstOrFail();

        $request->validate([
            'region' => 'required|string|max:255',
            'group_name' => 'required|string|max:255',
            'group_address' => 'required|string|max:255',
            'leader_name' => 'required|string|max:255',
            'number_of_pilgrims' => 'required|integer|min:1',
            'arrival_time' => 'required|date',
            'vehicle_type' => 'required|string|max:255',
            'number_of_vehicles' => 'required|integer|min:0',
            'contact_number' => 'required|string|max:20',
            'departure_time' => 'required|date|after_or_equal:arrival_time',
            'notes' => 'nullable|string',
        ]);

        $booking->update($request->only([
            'region',
            'group_name',
            'group_address',
            'leader_name',
            'number_of_pilgrims',
            'arrival_time',
            'vehicle_type',
            'number_of_vehicles',
            'contact_number',
            'departure_time',
            'notes'
        ]));

        return redirect()->route('tamu.bookings.show', $booking->id)
        ->with('success', 'Booking berhasil diperbarui.');
    }


}
