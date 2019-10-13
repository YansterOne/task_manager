<?php

namespace Fake\Project\Responses;

use Core\Project\Responses\GetProjectsResponse;

class FakeGetProjectsResponse implements GetProjectsResponse
{
    private $projects;

    public function setProjects(array $projects)
    {
        $this->projects = $projects;
    }

    public function getProjects(): array
    {
        return $this->projects;
    }

}
