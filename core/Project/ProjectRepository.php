<?php

namespace Core\Project;

interface ProjectRepository
{
    public function create(array $params): Project;
}
