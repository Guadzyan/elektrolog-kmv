<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Services\TelegramService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AppointmentsController extends Controller
{
    public function index(Request $request)
    {
        $validated = $request->validate([
            'status' => ['nullable', 'string'],
        ]);

        $query = Appointment::query()->with('client')->orderByDesc('starts_at');

        if (! empty($validated['status'])) {
            $query->where('status', $validated['status']);
        }

        return response()->json([
            'data' => $query->paginate(50),
        ]);
    }

    public function update(Request $request, Appointment $appointment, TelegramService $telegram)
    {
        $validated = $request->validate([
            'status' => ['nullable', 'in:pending,confirmed,rescheduled,cancelled,completed'],
            'starts_at' => ['nullable', 'date'],
            'duration_minutes' => ['nullable', 'integer', 'min:15', 'max:600'],
            'note' => ['nullable', 'string'],
        ]);

        $appointment->fill(array_filter($validated, fn ($v) => $v !== null));

        if ($appointment->isDirty('starts_at') && ($validated['status'] ?? null) === null) {
            $appointment->status = Appointment::STATUS_RESCHEDULED;
        }

        $appointment->save();

        $statusLabel = match ($appointment->status) {
            Appointment::STATUS_PENDING => 'ожидает подтверждения',
            Appointment::STATUS_CONFIRMED => 'подтверждено',
            Appointment::STATUS_RESCHEDULED => 'перенос',
            Appointment::STATUS_CANCELLED => 'отменено',
            Appointment::STATUS_COMPLETED => 'выполнено',
            default => (string) $appointment->status,
        };

        $startsAt = $appointment->starts_at
            ? Carbon::parse($appointment->starts_at)->format('d.m.Y H:i')
            : 'не указаны (уточнить)';
        $clientName = (string) optional($appointment->client)->name;
        $clientPhone = (string) optional($appointment->client)->phone;

        $telegram->send(
            '<b>Изменение записи</b>' . "\n\n".
            '<b>Статус</b>: ' . e($statusLabel) . "\n".
            '<b>Дата/время</b>: ' . e($startsAt) . "\n".
            'Длительность: ' . e((string) $appointment->duration_minutes) . ' мин' . "\n".
            '<b>Клиент</b>: ' . e($clientName) . "\n".
            '<b>Телефон</b>: <code>' . e($clientPhone) . '</code>'
        );

        return response()->json(['data' => $appointment->load('client')]);
    }
}
