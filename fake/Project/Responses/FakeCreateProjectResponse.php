<?php

namespace Fake\Project\Responses;

use Core\Project\Project;
use Core\Project\Responses\CreateProjectResponse;

class FakeCreateProjectResponse implements CreateProjectResponse
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
