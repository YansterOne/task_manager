<?php

namespace Fake\Project;

use Core\Project\Project;
use Core\Project\ProjectFactory;
use Core\Project\ProjectRepository;

class FakeProjectRepository implements ProjectRepository
{
    private $id = 0;
    private $projectFactory;
    private $projects = [];

    public function __construct(ProjectFactory $projectFactory)
    {
        $this->projectFactory = $projectFactory;
    }

    public function create(array $params): Project
    {
        $this->id++;
        $project = $this->projectFactory->create($this->id, $params['name']);
        array_push($this->projects, $project);
        return $project;
    }
}
