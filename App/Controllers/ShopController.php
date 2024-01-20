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
        $data["isAdmin"] = $this->getIsAdmin($this->findUser());
        $data["all-pizzas"] = $this->getAllPizzas();
        $data["filtered-pizzas"] = $this->getFilteredPizzas();
        return $this->html($data);
    }

    public function user(): Response
    {
        return $this->html();
    }

    public function profile(): Response
    {
        $user = User::getOne($this->findUser()->getId());
        $data = [
            "name" => $user->getLogin(),
            "email" => $user->getEmail(),
            "password" => $user->getPassword(),
            "isAdmin" => $user->getIsAdmin(),
            "imagePath" => $user->getProfileImage()
        ];
        return $this->html($data);
    }

    public function cart(): Response
    {
        $data = $this->getOrderedPizzas();
        return $this->html($data);
    }

    public function database(): Response
    {
        $data["isAdmin"] = $this->getIsAdmin($this->findUser());
        $data["users"] = $this->getFilteredUsers();
        return $this->html($data);
    }

    public function feedback(): Response
    {
        return $this->html();
    }

    public function order(): Response
    {
        return $this->html();
    }

    public function crudManagement(): Response
    {
        return $this->html();
    }

    public function cartManagement(): Response
    {
        return $this->html();
    }

    public function initPizzas(): Response
    {
        $pizzas = Pizza::getAll();
        foreach ($pizzas as $pizza) {
            $pizza->setAmount(0);
            $pizza->save();
        }
        return $this->redirect($this->url("shop.index"));
    }


    private function getAllPizzas(): array
    {
        $pizzas = Pizza::getAll();
        $data = [];
        if (count($pizzas) > 0) {
            for ($i = 0; $i < count($pizzas); $i++) {
                $data[$i]['id'] = $pizzas[$i]->getId();
                $data[$i]['name'] = $pizzas[$i]->getName();
                $data[$i]['description'] = $pizzas[$i]->getDescription();
                $data[$i]['cost'] = $pizzas[$i]->getCost();
                $data[$i]['image-path'] = "public/images/pizzas/" . $pizzas[$i]->getImagePath();
                $data[$i]['amount'] = $pizzas[$i]->getAmount();
            }
        }
        return $data;
    }

    private function getFilteredPizzas(): array
    {
        $regex = $this->app->getRequest()->getValue('search-field') ?? '';
        $pizzas = Pizza::getAll("`name` LIKE ?", ["%$regex%"]);
        $data = [];
        if (count($pizzas) > 0) {
            for ($i = 0; $i < count($pizzas); $i++) {
                $data[$i]['id'] = $pizzas[$i]->getId();
                $data[$i]['name'] = $pizzas[$i]->getName();
                $data[$i]['description'] = $pizzas[$i]->getDescription();
                $data[$i]['cost'] = $pizzas[$i]->getCost();
                $data[$i]['image-path'] = "public/images/pizzas/" . $pizzas[$i]->getImagePath();
                $data[$i]['amount'] = $pizzas[$i]->getAmount();
            }
        }
        return $data;
    }

    private function getOrderedPizzas(): array
    {
        $pizzas = Pizza::getAll("`amount` > ?", ["0"]);
        $data[] = [];
        for ($i = 0; $i < count($pizzas); $i++) {
            $data[$i]['id'] = $pizzas[$i]->getId();
            $data[$i]['name'] = $pizzas[$i]->getName();
            $data[$i]['description'] = $pizzas[$i]->getDescription();
            $data[$i]['cost'] = $pizzas[$i]->getCost();
            $data[$i]['image-path'] = "public/images/pizzas/" . $pizzas[$i]->getImagePath();
            $data[$i]['amount'] = $pizzas[$i]->getAmount();
        }
        return $data;
    }

    private function getFilteredUsers(): array
    {
        $regex = $this->app->getRequest()->getValue('search-field') ?? '';
        $users = User::getAll("`login` LIKE ?", ["%$regex%"]);
        $data = [];
        if (count($users) > 0) {
            for ($i = 0; $i < count($users); $i++) {
                $data[$i]['id'] = $users[$i]->getId();
                $data[$i]['name'] = $users[$i]->getLogin();
                $data[$i]['email'] = $users[$i]->getEmail();
                $data[$i]['isAdmin'] = $users[$i]->getIsAdmin();
            }
        }
        return $data;
    }

    public function findUser(): ?User
    {
        $users = User::getAll();
        foreach ($users as $user) {
            if ($user->getLogin() == $this->app->getAuth()->getLoggedUserName()) {
                return $user;
            }
        }
        return null;
    }

    public function getIsAdmin($user): int
    {
        return $user ? $user->getIsAdmin() : 0;
    }
}
