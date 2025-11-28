<?php

namespace App\Controller;

use App\Entity\Tools;
use App\Repository\ToolsRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Service\MetricsCalculator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use App\Repository\UsageLogsRepository;

final class ToolsController extends AbstractController
{

    public function __invoke(int $id, ToolsRepository $repository, MetricsCalculator $metricsCalculator, SerializerInterface $serializer, UsageLogsRepository $usageLogsRepository) : ?JsonResponse {
        $toolEntity = $repository->find($id);

        if (!$toolEntity) {
            throw new NotFoundHttpException("Tool with ID $id does not exist");
        }

        $tool = $serializer->normalize($toolEntity, null, ['groups' => ['read:tool', 'read:category']]);

        $tool['metrics'] = $metricsCalculator->getMetrics($toolEntity);

        return $this->json($tool);
    }
}