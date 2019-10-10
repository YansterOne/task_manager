<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Project\GetRequest;
use App\Http\Requests\Project\StoreRequest;
use App\Http\Requests\Project\UpdateRequest;
use App\Http\Responses\Project\CreateResponse;
use App\Http\Responses\Project\GetResponse;
use App\Http\Responses\Project\UpdateResponse;
use Core\Project\ProjectService;
use Illuminate\Http\JsonResponse;

class ProjectController extends Controller
{
    private $projectService;

    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    public function get(GetRequest $request): JsonResponse
    {
        $response = new GetResponse();
        $this->projectService->getProjects($request, $response);
        return $response;
    }

    public function store(StoreRequest $request): JsonResponse
    {
        $response = new CreateResponse();
        $this->projectService->createProject($request, $response);
        return $response;
    }

    public function update(UpdateRequest $request): JsonResponse
    {
        $response = new UpdateResponse();
        $this->projectService->updateProject($request, $response);
        return $response;
    }
}
