<?php

namespace App\Controller;

use App\Entity\Tools;
use App\Repository\ToolsRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ToolsController extends AbstractController
{

    public function __invoke(int $id, ToolsRepository $repository) {
        $tool = $repository->find($id);

        if (!$tool) {
            throw new NotFoundHttpException("Tool with ID $id does not exist");
        }
        return $this->json($tool);
    }
}