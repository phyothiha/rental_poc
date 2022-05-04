<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Rental;
use Illuminate\Http\Request;

class RentalController extends Controller
{
    public function index()
    {
        return view('frontend.rental.index');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'phone' => ['required'],
            'destination_from' => ['required'],
            'destination_to' => ['required'],
        ]);

        if ($request->hasFile('attachment')) {
            foreach ($request->file('attachment') as $field => $file) {
                $attributes[$field] = basename($file->store('rentals'));
            }
        }

        Rental::create($attributes);

        return response()->json([
            'message' => 'Request has been added successfully.'
        ]);
    }
}
