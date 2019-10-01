<?php

namespace Core\Project\Responses;

use Core\Project\Project;

interface CreateProjectResponse
{
    public function setProject(Project $project);
}
