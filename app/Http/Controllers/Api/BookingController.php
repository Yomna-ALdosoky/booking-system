<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index() {
        return Booking::all();
    }

    public function store(Request $request){
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'time'  => 'required|date',
            'date'  => 'required',
        ]);

        $booking= Booking::create([
            'user_id' =>$request->use()->id(),
            'service_id' => $request->service_id,
            'time' => $request->time,
            'date' => $request->date,
            'status' => $request->status,
        ]);
        return response()->json($booking, 201);

    }

    public function show(Booking $booking) {
        return $booking;
    }

    public function update(Request $request, Booking $booking) {
        $request->validate([
            'status' => 'sometimes|required|string|in:pending,confirmed,canceled'
        ]);

        $booking->update($request->all());
        return response()->json($booking);
    }

    public function delete(Booking $booking) {
        $booking->delete();
        return response()->json(['message' => 'Booking deleted successfully']);
    }
}
