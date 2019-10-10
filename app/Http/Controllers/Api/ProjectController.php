<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Project\StoreRequest;
use App\Http\Responses\Project\CreateResponse;
use Core\Project\ProjectService;
use Illuminate\Http\JsonResponse;

class ProjectController extends Controller
{
    private $projectService;

    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    public function store(StoreRequest $request): JsonResponse
    {
        $response = new CreateResponse();
        $this->projectService->createProject($request, $response);
        return $response;
    }

}
