<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\Pizza;

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

    public function profile(): Response
    {
        return $this->html();
    }

    public function database(): Response
    {
        $pizzas = Pizza::getAll(orderBy: '`id` asc');
        $data = [][5];

        for ($i = 0; $i < count($pizzas); $i++) {
            $data[$i][0] = $pizzas[$i]->getId();
            $data[$i][1] = $pizzas[$i]->getName();
            $data[$i][2] = $pizzas[$i]->getDescription();
            $data[$i][3] = $pizzas[$i]->getCost();
            $data[$i][4] = $pizzas[$i]->getImagePath();
        }

        return $this->html($data);
    }

    public function feedback(): Response
    {
        return $this->html();
    }

    public function add(): Response
    {
        return $this->html();
    }

    public function update(): Response
    {
        return $this->html();
    }

    public function remove(): Response
    {
        return $this->html();
    }
}