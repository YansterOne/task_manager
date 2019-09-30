<?php

namespace Core\Project;

abstract class AbstractProjectService
{
    abstract public function createProject(string $name): Project;
}
