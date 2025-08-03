<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Carbon\Carbon;

class DashboardController extends Controller
{
    // Tambahkan parameter Request $request untuk mendapatkan data dari form
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = Booking::query();

        if ($search) {
            $query->where('group_name', 'like', '%' . $search . '%')
                  ->orWhere('leader_name', 'like', '%' . $search . '%')
                  ->orWhere('region', 'like', '%' . $search . '%')
                  ->orWhere('group_address', 'like', '%' . $search . '%')
                  ->orWhere('booking_code', 'like', '%' . $search . '%');
        }

        $bookings = $query->orderBy('created_at', 'desc')->get();
        $totalBookings = $query->count();
        $totalOrang = $query->sum('number_of_pilgrims');
        $totalKendaraan = $query->sum('number_of_vehicles');
        $totalMaktab = $query->distinct('maktab_id')->count();
        
        $lastUpdated = Carbon::now()->format('g:i:s A');

        // Kirim semua data ke view
        return view('welcome', [
            'totalBookings' => $totalBookings,
            'totalOrang' => $totalOrang,
            'totalKendaraan' => $totalKendaraan,
            'totalMaktab' => $totalMaktab,
            'lastUpdated' => $lastUpdated,
            'search' => $search,
            'bookings' => $bookings,
        ]);
    }

    public function show(string $id)
    {
        $booking = Booking::with('maktab')->findOrFail($id);
        $maktab = $booking->maktab;
        return view('detail', compact('booking', 'maktab'));
    }
}
