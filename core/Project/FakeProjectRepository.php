<?php

namespace Core\Project;

class FakeProjectRepository implements ProjectRepository
{
    private $id = 0;
    private $projectFactory;

    public function __construct()
    {
        $this->projectFactory = new ProjectFactory();
    }

    public function create(array $params): Project
    {
        $this->id++;
        $id = $this->id;
        return $this->projectFactory->create($id, $params['name']);
    }
}
