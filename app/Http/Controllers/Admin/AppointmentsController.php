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
            'q' => ['nullable', 'string', 'max:255'],
            'date_range' => ['nullable', 'in:today,tomorrow,week'],
            'no_date' => ['nullable', 'boolean'],
        ]);

        $query = Appointment::query()
            ->with('client')
            ->orderByRaw('CASE WHEN starts_at IS NULL THEN 1 ELSE 0 END')
            ->orderByDesc('starts_at');

        if (! empty($validated['status'])) {
            $query->where('status', $validated['status']);
        }

        if (! empty($validated['q'])) {
            $q = trim((string) $validated['q']);
            $digits = preg_replace('/\D+/', '', $q);

            $query->whereHas('client', function ($sub) use ($q, $digits) {
                $sub->where('name', 'like', '%' . $q . '%');
                if ($digits !== '') {
                    $sub->orWhere('phone', 'like', '%' . $digits . '%');
                    $sub->orWhere('phone', 'like', '%' . $q . '%');
                } else {
                    $sub->orWhere('phone', 'like', '%' . $q . '%');
                }
            });
        }

        if (! empty($validated['no_date'])) {
            $query->whereNull('starts_at');
        }

        if (! empty($validated['date_range'])) {
            $range = (string) $validated['date_range'];

            if ($range === 'today') {
                $start = Carbon::today();
                $end = Carbon::tomorrow();
                $query->whereNotNull('starts_at')->whereBetween('starts_at', [$start, $end]);
            }

            if ($range === 'tomorrow') {
                $start = Carbon::tomorrow();
                $end = Carbon::tomorrow()->addDay();
                $query->whereNotNull('starts_at')->whereBetween('starts_at', [$start, $end]);
            }

            if ($range === 'week') {
                $start = Carbon::today();
                $end = Carbon::today()->addDays(7);
                $query->whereNotNull('starts_at')->whereBetween('starts_at', [$start, $end]);
            }
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

        $utmParts = array_values(array_filter([
            $appointment->utm_source ?? null,
            $appointment->utm_medium ?? null,
            $appointment->utm_campaign ?? null,
        ], fn ($v) => $v !== null && trim((string) $v) !== ''));

        $attributionLines = [];
        if (! empty($utmParts)) {
            $attributionLines[] = '<b>UTM</b>: ' . e(implode(' / ', $utmParts));
        }
        if (! empty(trim((string) ($appointment->landing_url ?? '')))) {
            $attributionLines[] = '<b>Landing</b>: ' . e((string) $appointment->landing_url);
        }
        if (! empty(trim((string) ($appointment->referrer ?? '')))) {
            $attributionLines[] = '<b>Referrer</b>: ' . e((string) $appointment->referrer);
        }
        $attributionBlock = ! empty($attributionLines)
            ? ("\n\n" . '<b>Источник/UTM</b>' . "\n" . implode("\n", $attributionLines))
            : '';

        $telegram->send(
            '<b>Изменение записи</b>' . "\n\n".
            '<b>Статус</b>: ' . e($statusLabel) . "\n".
            '<b>Дата/время</b>: ' . e($startsAt) . "\n".
            'Длительность: ' . e((string) $appointment->duration_minutes) . ' мин' . "\n".
            '<b>Клиент</b>: ' . e($clientName) . "\n".
            '<b>Телефон</b>: <code>' . e($clientPhone) . '</code>'.
            $attributionBlock
        );

        return response()->json(['data' => $appointment->load('client')]);
    }
}
