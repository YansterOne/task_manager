<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\StoreRequest;
use App\Http\Responses\Task\StoreResponse;
use Core\Task\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    private $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function store(StoreRequest $request)
    {
        $response = new StoreResponse();
        $this->taskService->addTask($request, $response);
        return $response;
    }
}
