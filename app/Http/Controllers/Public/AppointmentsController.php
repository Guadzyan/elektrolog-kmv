<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Client;
use App\Services\TelegramService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AppointmentsController extends Controller
{
    public function store(Request $request, TelegramService $telegram)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:32'],
            'telegram_username' => ['nullable', 'string', 'max:255'],
            'starts_at' => ['nullable', 'date'],
            'preferred_date' => ['nullable', 'date_format:Y-m-d'],
            'duration_minutes' => ['nullable', 'integer', 'min:15', 'max:600'],
            'needle_type' => ['nullable', 'in:body,face'],
            'note' => ['nullable', 'string'],
            'utm_source' => ['nullable', 'string', 'max:128'],
            'utm_medium' => ['nullable', 'string', 'max:128'],
            'utm_campaign' => ['nullable', 'string', 'max:128'],
            'utm_content' => ['nullable', 'string', 'max:128'],
            'utm_term' => ['nullable', 'string', 'max:128'],
            'landing_url' => ['nullable', 'string', 'max:512'],
            'referrer' => ['nullable', 'string', 'max:512'],
        ]);

        $client = Client::query()->firstOrCreate(
            ['phone' => $validated['phone']],
            [
                'name' => $validated['name'],
                'telegram_username' => $validated['telegram_username'] ?? null,
                'note' => null,
            ]
        );

        if ($client->name !== $validated['name'] || ($validated['telegram_username'] ?? null) !== $client->telegram_username) {
            $client->fill([
                'name' => $validated['name'],
                'telegram_username' => $validated['telegram_username'] ?? null,
            ])->save();
        }

        $note = $validated['note'] ?? null;
        if (! empty($validated['preferred_date']) && empty($validated['starts_at'])) {
            $preferred = Carbon::parse($validated['preferred_date'])->format('d.m.Y');
            $note = trim((string) ($note ?? ''));
            $note = $note === ''
                ? ('Предпочтительная дата: ' . $preferred)
                : ('Предпочтительная дата: ' . $preferred . "\n" . $note);
        }

        $appointment = Appointment::query()->create([
            'client_id' => $client->id,
            'starts_at' => $validated['starts_at'] ?? null,
            'duration_minutes' => (int) ($validated['duration_minutes'] ?? 60),
            'status' => Appointment::STATUS_PENDING,
            'source' => 'web',
            'utm_source' => $validated['utm_source'] ?? null,
            'utm_medium' => $validated['utm_medium'] ?? null,
            'utm_campaign' => $validated['utm_campaign'] ?? null,
            'utm_content' => $validated['utm_content'] ?? null,
            'utm_term' => $validated['utm_term'] ?? null,
            'landing_url' => $validated['landing_url'] ?? $request->fullUrl(),
            'referrer' => $validated['referrer'] ?? $request->headers->get('referer'),
            'needle_type' => $validated['needle_type'] ?? null,
            'note' => $note,
        ]);

        $startsAt = $appointment->starts_at
            ? Carbon::parse($appointment->starts_at)->format('d.m.Y H:i')
            : 'не указаны (уточнить)';

        $rawDigits = preg_replace('/\D+/', '', (string) $client->phone);
        if (str_starts_with((string) $rawDigits, '8')) {
            $rawDigits = '7' . substr((string) $rawDigits, 1);
        }
        if (str_starts_with((string) $rawDigits, '7')) {
            $rawDigits = substr((string) $rawDigits, 1);
        }
        $rawDigits = substr((string) $rawDigits, 0, 10);
        $telPhone = '+7' . $rawDigits;
        $displayPhone = '+7';
        if (strlen($rawDigits) > 0) {
            $displayPhone .= '(' . substr($rawDigits, 0, 3);
            if (strlen($rawDigits) >= 3) {
                $displayPhone .= ')';
            }
            if (strlen($rawDigits) > 3) {
                $displayPhone .= substr($rawDigits, 3, 3);
            }
            if (strlen($rawDigits) > 6) {
                $displayPhone .= '-' . substr($rawDigits, 6, 2);
            }
            if (strlen($rawDigits) > 8) {
                $displayPhone .= '-' . substr($rawDigits, 8, 2);
            }
        }

        $tg = trim((string) ($client->telegram_username ?? ''));
        if ($tg !== '' && ! str_starts_with($tg, '@')) {
            $tg = '@' . ltrim($tg, '@');
        }
        $tgLine = $tg !== '' ? ('<b>Telegram</b>: ' . e($tg) . "\n") : '';

        $needleLabel = match ($appointment->needle_type) {
            'body' => 'тело',
            'face' => 'лицо',
            default => '—',
        };

        $timeLine = $appointment->starts_at
            ? ('Дата и время: ' . e($startsAt))
            : ('Дата/время: ' . e($startsAt));

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

        $msg = '<b>Новая заявка на электроэпиляцию</b>' . "\n\n".
            '<b>Клиент</b>: ' . e($client->name) . "\n".
            '<b>Телефон</b>: <a href="tel:' . e($telPhone) . '">' . e($displayPhone) . '</a>' . "\n".
            $tgLine.
            $timeLine . "\n".
            'Длительность: ' . e((string) $appointment->duration_minutes) . ' мин' . "\n".
            'Зона: ' . e($needleLabel).
            $attributionBlock . "\n\n".
            '<b>Комментарий</b>: ' . e(Str::limit((string) ($appointment->note ?? '—'), 700));

        $telegram->send($msg);

        return response()->json([
            'id' => $appointment->id,
            'status' => $appointment->status,
        ], 201);
    }
}
