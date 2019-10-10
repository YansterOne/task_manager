<?php

namespace App\Http\Responses\Project;

use Core\Project\Project;
use Core\Project\Responses\UpdateProjectResponse;
use Illuminate\Http\JsonResponse;

class UpdateResponse extends JsonResponse implements UpdateProjectResponse
{
    public function setProject(Project $project)
    {
        $this->setData([
            'id' => $project->getId(),
            'name' => $project->getName(),
        ]);
    }

}
