<?php

namespace App\Http\Responses\Task;

use App\Http\Requests\AuthRequest;
use Core\Task\Requests\DeleteTaskRequest;

class DeleteRequest extends AuthRequest implements DeleteTaskRequest
{
    public function rules()
    {
        return [];
    }

    public function getTaskID(): int
    {
        return $this->route('id');
    }
}
