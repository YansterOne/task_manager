<?php

namespace Core\Project;

use Core\Project\Requests\Create;

abstract class AbstractProjectService
{
    abstract public function createProject(Create $request): Project;
}
