<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\Pizza;
use App\Models\User;

class ShopController extends AControllerBase
{
    /**
     * @inheritDoc
     */
    public function index(): Response
    {
        $data["admin"] = $this->getIsAdmin();
        $data["pizzas"] = $this->getPizzas();

        return $this->html($data);
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
        $data = $this->getPizzas();
        return $this->html($data);
    }

    public function feedback(): Response
    {
        return $this->html();
    }

    public function cart(): Response
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

    public function getPizzas(): array
    {
        $pizzas = Pizza::getAll(orderBy: '`id` asc');
        $data[] = [];

        for ($i = 0; $i < count($pizzas); $i++) {
            $data[$i]['id'] = $pizzas[$i]->getId();
            $data[$i]['name'] = $pizzas[$i]->getName();
            $data[$i]['description'] = $pizzas[$i]->getDescription();
            $data[$i]['cost'] = number_format($pizzas[$i]->getCost(), 2);
            $data[$i]['image-path'] = "public/images/pizzas/" . $pizzas[$i]->getImagePath();
        }
        return $data;
    }

    public function getIsAdmin(): int
    {
        $users = User::getAll();
        $isAdmin = 0;
        foreach ($users as $user) {
            if ($user->getLogin() == $_SESSION["user"]) {
                $isAdmin = $user->getIsAdmin();
            }
        }

        return $isAdmin;
    }
}
