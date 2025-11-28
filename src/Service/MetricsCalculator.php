<?php

namespace App\Service;

class MetricsCalculator
{
    public function getMetrics() : array {
        $totalSessions = 127;
        $avgMinutes = 45;
        return [
            'last_30_days' => [
                'total_sessions' => $totalSessions,
                'avg_session_minutes' => $avgMinutes
            ]
        ];
    }
}