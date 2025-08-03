<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Maktab;

class MaktabController extends Controller
{
    public function show($id)
    {
        $maktab = Maktab::findOrFail($id);
        $booking = Booking::where('maktab_id', $id)->first();
        return view('maktab', compact('maktab', 'booking'));
    }
}
