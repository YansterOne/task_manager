<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public $timestamps = false;

    public function getId(): int
    {
        return $this->id;
    }
}
