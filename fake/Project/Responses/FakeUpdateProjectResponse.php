<?php

namespace Fake\Project\Responses;

use Core\Project\Project;
use Core\Project\Responses\UpdateProjectResponse;

class FakeUpdateProjectResponse implements UpdateProjectResponse
{
    private $project;

    public function setProject(Project $project)
    {
        $this->project = $project;
    }

    public function getProject(): ?Project
    {
        return $this->project;
    }
}
