<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Maktab;

class MaktabController extends Controller
{
    public function show($id)
    {
        $maktab = Maktab::findOrFail($id);
        $booking = Booking::where('maktab_id', $id)->first();
        return view('tamu.maktab.show', compact('maktab', 'booking'));
    }
}
