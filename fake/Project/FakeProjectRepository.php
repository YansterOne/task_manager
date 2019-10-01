<?php

namespace Fake\Project;

use Core\Project\Project;
use Core\Project\ProjectRepository;

class FakeProjectRepository implements ProjectRepository
{
    private $id = 0;
    private $projects = [];

    public function __construct(array $projects = [])
    {
        foreach ($projects as $project) {
            $id = ++$this->id;
            $this->projects[$id] = $project;
        }
    }

    public function create(Project $project): int
    {
        $id = ++$this->id;
        $this->projects[$id] = $project;
        return $id;
    }

    public function get(): array
    {
        return $this->projects;
    }
}
