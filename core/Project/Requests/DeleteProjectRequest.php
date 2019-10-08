<?php

namespace Core\Project\Requests;

interface DeleteProjectRequest
{
    public function getAuthUserID(): int;

    public function getProjectID(): int;
}
