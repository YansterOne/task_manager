<?php

namespace Core\Project;

interface ProjectFactory
{
    public function create(string $name): Project;
}
