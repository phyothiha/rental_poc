<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Rental;
use Illuminate\Http\Request;

class RentalController extends Controller
{
    public function index()
    {
        return view('backend.rental.index');
    }

    public function rentals()
    {
        return response()->json([
            'data' => Rental::latest()->paginate()
        ]);
    }

    public function updateStatus(Rental $rental, $status)
    {
        $rental->update([
            'status' => $status
        ]);

        return response()->json([
            'message' => 'success',
        ]);
    }
}
