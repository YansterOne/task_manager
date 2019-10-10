<?php

namespace App\Http\Responses\Project;

use Core\Project\Project;
use Core\Project\Responses\GetProjectsResponse;
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
            $data[] = [
                'id' => $project->getId(),
                'name' => $project->getName(),
                'tasks' => [],
            ];
        }
        $this->setData($data);
    }

}
