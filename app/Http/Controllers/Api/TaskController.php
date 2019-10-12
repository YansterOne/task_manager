<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\StoreRequest;
use App\Http\Requests\Task\UpdateRequest;
use App\Http\Responses\Task\StoreResponse;
use App\Http\Responses\Task\UpdateResponse;
use Core\Task\TaskService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    private $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function store(StoreRequest $request): JsonResponse
    {
        $response = new StoreResponse();
        $this->taskService->addTask($request, $response);
        return $response;
    }

    public function update(UpdateRequest $request): JsonResponse
    {
        $response = new UpdateResponse();
        $this->taskService->updateTask($request, $response);
        return $response;
    }
}
