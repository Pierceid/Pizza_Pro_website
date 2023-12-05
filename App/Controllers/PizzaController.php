<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use Pizza;

class PizzaController extends AControllerBase
{

    /**
     * @inheritDoc
     */
    public function index(): Response
    {
        Pizza::getAll();
        return $this->html();
    }

}