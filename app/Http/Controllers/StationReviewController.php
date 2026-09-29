<?php

namespace App\Http\Controllers;

use App\Models\StationReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Location;

class StationReviewController extends Controller
{
    public function store(Request $request, $id_station)
    {
        $validated = $request->validate([
            'rating' => [
                'required',
                'integer',
                'min:1',
                'max:5'
            ],

            'ulasan' => [
                'nullable',
                'string',
                'max:1000'
            ],
        ]);

        StationReview::updateOrCreate(
            [
                'id_station' => $id_station,
                'id_user' => Auth::id(),
            ],
            [
                'rating' => $validated['rating'],
                'ulasan' => $validated['ulasan'] ?? null,
            ]
        );

        return back()->with(
            'success',
            'Rating dan ulasan berhasil disimpan.'
        );
    }
}