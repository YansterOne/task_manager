<?php

namespace Core\Project\Responses;

use Core\Project\Project;

interface UpdateProjectResponse
{
    public function setProject(Project $project);
}
