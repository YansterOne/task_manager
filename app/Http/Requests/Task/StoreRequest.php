<?php

namespace App\Http\Requests\Task;

use App\Http\Requests\AuthRequest;
use Core\Task\Requests\AddTaskRequest;

class StoreRequest extends AuthRequest implements AddTaskRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'project_id' => 'required|integer',
            'name' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'priority' => 'required|integer',
            'deadline' => 'sometimes|nullable|date',
        ];
    }

    public function getProjectID(): int
    {
        return $this->get('project_id');
    }

    public function getName(): string
    {
        return $this->get('name');
    }

    public function getStatus(): string
    {
        return $this->get('status');
    }

    public function getPriority(): int
    {
        return $this->get('priority');
    }

    public function getDeadline(): ?\DateTime
    {
        return $this->get('deadline');
    }
}
