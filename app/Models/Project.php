<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public $timestamps = false;
    protected $guarded = ['id'];

    public function getId(): int
    {
        return $this->id;
    }
}
