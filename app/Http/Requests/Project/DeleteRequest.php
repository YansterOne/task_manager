<?php

namespace App\Http\Requests\Project;

use App\Http\Requests\AuthRequest;
use Core\Project\Requests\DeleteProjectRequest;

class DeleteRequest extends AuthRequest implements DeleteProjectRequest
{
    public function rules()
    {
        return [];
    }

    public function getProjectID(): int
    {
        return (int)$this->route('id');
    }
}
