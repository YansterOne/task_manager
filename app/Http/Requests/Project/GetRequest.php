<?php

namespace App\Http\Requests\Project;

use App\Http\Requests\AuthRequest;
use Core\Project\Requests\GetProjectsRequest;

class GetRequest extends AuthRequest implements GetProjectsRequest
{
    public function rules()
    {
        return [];
    }
}
