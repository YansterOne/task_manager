<?php

namespace Core\Project\Requests;

interface CreateProjectRequest
{
    public function getAuthUserID(): int;

    public function getName(): string;
}
