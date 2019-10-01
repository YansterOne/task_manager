<?php

namespace Core\Project\Responses;

use Core\Project\Project;

interface GetProjectsResponse
{
    /**
     * @param Project[] $projects
     * @return mixed
     */
    public function setProjects(array $projects);
}
