<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;

class ShopController extends AControllerBase
{

    /**
     * @inheritDoc
     */
    public function index(): Response
    {
        return $this->html();
    }

    public function intro(): Response
    {
        return $this->html();
    }

    public function cart(): Response
    {
        return $this->html();
    }

    public function feedback(): Response
    {
        return $this->html();
    }
}