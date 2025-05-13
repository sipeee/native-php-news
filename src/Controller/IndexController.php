<?php

namespace App\Controller;

use App\Model\Repository;

class IndexController
{
    public function __invoke()
    {
        $repository = new Repository();
        var_dump($repository->queryNews());
    }
}