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

    public function user(): Response
    {
        return $this->html();
    }

    public function profile(): Response {
        return $this->html();
    }

    public function add(): Response
    {
        return $this->redirect($this->url('shop.add'));
    }

    public function remove(): Response
    {
        return $this->redirect($this->url('shop.remove'));
    }

    public function feedback(): Response
    {
        return $this->html();
    }
}