<?php

namespace App\Http\Requests\Project;

use App\Http\Requests\AuthRequest;
use Core\Project\Requests\UpdateProjectRequest;

class UpdateRequest extends AuthRequest implements UpdateProjectRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string'
        ];
    }

    public function getName(): string
    {
        return $this->get('name');
    }

    public function getProjectID(): int
    {
        return (int)$this->route('id');
    }
}
