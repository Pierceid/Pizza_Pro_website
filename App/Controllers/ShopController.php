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

    public function cart(): Response
    {
        return $this->redirect($this->url('shop.cart'));
    }

    public function feedback(): Response
    {
        return $this->html();
    }
}