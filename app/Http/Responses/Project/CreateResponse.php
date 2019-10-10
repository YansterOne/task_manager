<?php


namespace App\Http\Responses\Project;


use Core\Project\Project;
use Core\Project\Responses\CreateProjectResponse;
use Illuminate\Http\JsonResponse;

class CreateResponse extends JsonResponse implements CreateProjectResponse
{
    public function setProject(Project $project)
    {
        $this->setData(['id' => $project->getId(), 'name' => $project->getName()]);
    }
}
