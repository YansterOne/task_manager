<?php

namespace App\Http\Responses\Project;

use Core\Project\Project;
use Core\Project\Responses\GetProjectsResponse;
use Core\Task\Task;
use Illuminate\Http\JsonResponse;

class GetResponse extends JsonResponse implements GetProjectsResponse
{
    /**
     * @param Project[] $projects
     * @return mixed|void
     */
    public function setProjects(array $projects)
    {
        $data = [];
        foreach ($projects as $project) {
            $tasks = array_map(function (Task $task) {
                return [
                    'id' => $task->getId(),
                    'name' => $task->getName(),
                    'status' => $task->getStatus(),
                    'priority' => $task->getPriority(),
                    'deadline' => $task->getDeadline() ? $task->getDeadline()->format('Y-m-d H:i:s') : null,
                    'project_id' => $task->getProject()->getId(),
                ];
            }, $project->getTasks());
            $data[] = [
                'id' => $project->getId(),
                'name' => $project->getName(),
                'tasks' => $tasks,
            ];
        }
        $this->setData($data);
    }

}
