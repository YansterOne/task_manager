<?php


namespace App\Http\Responses\Task;


use Core\Task\Responses\UpdateTaskResponse;
use Core\Task\Task;
use Illuminate\Http\JsonResponse;

class UpdateResponse extends JsonResponse implements UpdateTaskResponse
{
    public function setTask(Task $task)
    {
        $this->setData([
            'id' => $task->getId(),
            'name' => $task->getName(),
            'status' => $task->getStatus(),
            'priority' => $task->getPriority(),
            'deadline' => $task->getDeadline() ? $task->getDeadline()->format('Y-m-d H:i:s') : null,
            'project_id' => $task->getProject()->getId(),
        ]);
    }
}
