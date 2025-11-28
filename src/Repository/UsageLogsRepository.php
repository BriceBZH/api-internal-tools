<?php

namespace App\Repository;

use App\Entity\UsageLogs;
use App\Entity\Tools;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UsageLogs>
 */
class UsageLogsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UsageLogs::class);
    }

    public function findByLast30Days(Tools $tool) : array {
        $date = new \DateTimeImmutable();
        $searchDate = $date->modify('-30days');
        $result = $this->createQueryBuilder('ul')
            ->select('COUNT(ul.id) AS total_sessions')
            ->addSelect('SUM(ul.usageMinutes) AS total_minutes')
            ->andWhere('ul.tool = :tool')
            ->andWhere('ul.createdAt >= :date')
            ->setParameter('date', $searchDate)
            ->setParameter('tool', $tool)
            ->getQuery()
            ->getOneOrNullResult();

        return [
            'total_sessions' => $result['total_sessions'],
            'total_minutes'  => $result['total_minutes']
        ];
    }
}