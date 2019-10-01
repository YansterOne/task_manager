<?php

namespace Core\Project;

use Core\Project\Requests\CreateProjectRequest;
use Core\Project\Responses\CreateProjectResponse;

abstract class AbstractProjectService
{
    abstract public function createProject(CreateProjectRequest $request, CreateProjectResponse $response);
}
