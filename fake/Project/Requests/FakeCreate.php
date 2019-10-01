<?php

namespace Fake\Project\Requests;

use Core\Project\Requests\Create;
use Faker\Provider\Lorem;

class FakeCreate implements Create
{
    public function getName(): string
    {
        return Lorem::words(rand(1, 10), true);
    }
}
