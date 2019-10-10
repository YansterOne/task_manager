<?php

namespace App\Http\Requests\Project;

use App\Http\Requests\AuthRequest;
use Core\Project\Requests\CreateProjectRequest;

class StoreRequest extends AuthRequest implements CreateProjectRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string',
        ];
    }

    public function getName(): string
    {
        return $this->get('name');
    }
}
