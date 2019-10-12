<?php

namespace App\Http\Responses\Task;

use Core\Task\Responses\AddTaskResponse;
use Core\Task\Task;
use Illuminate\Http\JsonResponse;

class StoreResponse extends JsonResponse implements AddTaskResponse
{
    public function setTask(Task $task)
    {
        $this->setData([
            'id' => $task->getId(),
            'name' => $task->getName(),
            'status' => $task->getStatus(),
            'priority' => $task->getPriority(),
            'deadline' => $task->getDeadline()->format('Y-m-d H:i:s'),
            'project_id' => $task->getProject()->getId(),
        ]);
    }
}
