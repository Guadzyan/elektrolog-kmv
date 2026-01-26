<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WorkingInterval;
use Illuminate\Http\Request;

class WorkingIntervalsController extends Controller
{
    public function index()
    {
        return response()->json([
            'data' => WorkingInterval::query()->orderBy('starts_at')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'starts_at' => ['required', 'date'],
            'ends_at' => ['required', 'date', 'after:starts_at'],
            'note' => ['nullable', 'string'],
        ]);

        $interval = WorkingInterval::query()->create($validated);

        return response()->json(['data' => $interval], 201);
    }

    public function update(Request $request, WorkingInterval $workingInterval)
    {
        $validated = $request->validate([
            'starts_at' => ['required', 'date'],
            'ends_at' => ['required', 'date', 'after:starts_at'],
            'note' => ['nullable', 'string'],
        ]);

        $workingInterval->update($validated);

        return response()->json(['data' => $workingInterval]);
    }

    public function destroy(WorkingInterval $workingInterval)
    {
        $workingInterval->delete();

        return response()->json(['status' => 'ok']);
    }
}
