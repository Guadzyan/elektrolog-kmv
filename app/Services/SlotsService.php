<?php

namespace App\Services;

use App\Models\Appointment;
use App\Models\WorkingInterval;
use Carbon\CarbonImmutable;

class SlotsService
{
    /**
     * @return array<int, array{starts_at: string, ends_at: string}>
     */
    public function getAvailableSlotsForDate(string $date, int $durationMinutes = 60, int $stepMinutes = 30): array
    {
        $dayStart = CarbonImmutable::parse($date)->startOfDay();
        $dayEnd = $dayStart->endOfDay();

        $intervals = WorkingInterval::query()
            ->where('ends_at', '>', $dayStart)
            ->where('starts_at', '<', $dayEnd)
            ->orderBy('starts_at')
            ->get(['starts_at', 'ends_at']);

        $blockingAppointments = Appointment::query()
            ->whereIn('status', [
                Appointment::STATUS_PENDING,
                Appointment::STATUS_CONFIRMED,
                Appointment::STATUS_RESCHEDULED,
            ])
            ->where('starts_at', '>=', $dayStart->subDay())
            ->where('starts_at', '<=', $dayEnd->addDay())
            ->get(['starts_at', 'duration_minutes']);

        $busy = [];
        foreach ($blockingAppointments as $a) {
            $aStart = CarbonImmutable::parse($a->starts_at);
            $aEnd = $aStart->addMinutes((int) $a->duration_minutes);
            $busy[] = [$aStart, $aEnd];
        }

        $slots = [];

        foreach ($intervals as $interval) {
            $cursor = CarbonImmutable::parse($interval->starts_at);
            $end = CarbonImmutable::parse($interval->ends_at);

            while ($cursor->addMinutes($durationMinutes)->lessThanOrEqualTo($end)) {
                $candidateStart = $cursor;
                $candidateEnd = $candidateStart->addMinutes($durationMinutes);

                $overlaps = false;
                foreach ($busy as [$bStart, $bEnd]) {
                    if ($candidateStart->lessThan($bEnd) && $candidateEnd->greaterThan($bStart)) {
                        $overlaps = true;
                        break;
                    }
                }

                if (! $overlaps) {
                    $slots[] = [
                        'starts_at' => $candidateStart->toIso8601String(),
                        'ends_at' => $candidateEnd->toIso8601String(),
                    ];
                }

                $cursor = $cursor->addMinutes($stepMinutes);
            }
        }

        return $slots;
    }
}
