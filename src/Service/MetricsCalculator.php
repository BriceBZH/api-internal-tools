<?php

namespace App\Service;

use App\Entity\UsageLogs;
use App\Entity\Tools;
use App\Repository\UsageLogsRepository;

class MetricsCalculator
{
    public function __construct(UsageLogsRepository $usageLogsRepository) {
        $this->usageLogsRepository = $usageLogsRepository;
    }
    
    public function getMetrics(Tools $tool) : array {
        $logs = $this->usageLogsRepository->findByLast30Days($tool);

        $avgMinutes = $logs['total_sessions'] > 0 ? round($logs['total_minutes'] / $logs['total_sessions']) : 0;

    return [
        'last_30_days' => [
            'total_sessions' => $logs['total_sessions'],
            'avg_session_minutes' => $avgMinutes
        ]
    ];
}

}