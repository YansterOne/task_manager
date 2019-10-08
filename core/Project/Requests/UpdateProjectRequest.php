<?php

namespace Core\Project\Requests;

interface UpdateProjectRequest
{
    public function getAuthUserID(): int;

    public function getName(): string;

    public function getProjectID(): int;
}
