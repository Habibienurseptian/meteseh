<?php

namespace App\Http\Controllers\Staf;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Maktab;


class StafController extends Controller
{
    /**
     * Menampilkan halaman dashboard utama.
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


        return view('staf.index', compact('totalBookings', 'totalOrang', 'totalKendaraan', 'totalMaktab', 'recentBookings'));
    }
}
