<?php

namespace Core\Project;

interface ProjectFactory
{
    public function create(int $id, string $name): Project;
}
