<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Services\SlotsService;
use Illuminate\Http\Request;

class SlotsController extends Controller
{
    public function __invoke(Request $request, SlotsService $slots)
    {
        $validated = $request->validate([
            'date' => ['required', 'date_format:Y-m-d'],
            'duration_minutes' => ['nullable', 'integer', 'min:15', 'max:600'],
        ]);

        $duration = (int) ($validated['duration_minutes'] ?? 60);

        return response()->json([
            'date' => $validated['date'],
            'duration_minutes' => $duration,
            'slots' => $slots->getAvailableSlotsForDate($validated['date'], $duration),
        ]);
    }
}
