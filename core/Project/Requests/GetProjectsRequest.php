<?php

namespace Core\Project\Requests;

interface GetProjectsRequest
{
    public function getAuthUserID(): int;
}
