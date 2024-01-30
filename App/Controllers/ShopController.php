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
        $data["is-admin"] = $this->findUser()->getIsAdmin();
        $data["all-pizzas"] = $this->getAllPizzas();
        $data["filtered-pizzas"] = $this->getFilteredPizzas();
        return $this->html($data);
    }

    public function profile(): Response
    {
        $user = User::getOne($this->findUser()->getId());
        $data = [
            "user-id" => $user->getId(),
            "name" => $user->getLogin(),
            "email" => $user->getEmail(),
            "password" => $user->getPassword(),
            "is-admin" => $user->getIsAdmin(),
            "image-path" => $user->getProfileImage()
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
        $data["is-admin"] = $this->findUser()->getIsAdmin();
        $data["users"] = $this->getFilteredUsers();
        return $this->html($data);
    }

    public function about(): Response
    {
        return $this->html();
    }

    public function feedback(): Response
    {
        $user = User::getOne($this->findUser()->getId());
        $data = [
            "name" => $user->getLogin(),
            "email" => $user->getEmail(),
            "image-path" => "public/images/profiles/" . $user->getProfileImage()
        ];
        return $this->html($data);
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
        return $this->getPizzaData($pizzas);
    }

    private function getFilteredPizzas(): array
    {
        $formData = $this->app->getRequest();
        $name = $formData->getValue('name-field') ?? '';
        $minCost = $formData->getValue('min-cost-field') ?? '';
        $maxCost = $formData->getValue('max-cost-field') ?? '';

        $sql = "`name` LIKE ?";
        $parameters = ["%$name%"];
        if (!empty($minCost) && $minCost <= $maxCost) {
            $sql .= " AND `cost` > ?";
            $parameters[] = "$minCost";
        }
        if (!empty($maxCost) && $maxCost >= $minCost) {
            $sql .= " AND `cost` < ?";
            $parameters[] = "$maxCost";
        }

        $pizzas = Pizza::getAll($sql, $parameters);
        return $this->getPizzaData($pizzas);
    }

    private function getOrderedPizzas(): array
    {
        $pizzas = Pizza::getAll("`amount` > ?", ["0"]);
        return $this->getPizzaData($pizzas);
    }

    private function getFilteredUsers(): array
    {
        $formData = $this->app->getRequest();
        $login = $formData->getValue('login-field') ?? '';
        $email = $formData->getValue('email-field') ?? '';
        $isAdmin = $formData->getValue('is-admin-field') ?? '';

        $sql = "`login` LIKE ? AND `email` LIKE ?";
        $parameters = ["%$login%", "%$email%"];
        if (in_array($isAdmin, [0, 1])) {
            $sql .= " AND `isAdmin` = ?";
            $parameters[] = "$isAdmin";
        }

        $users = User::getAll($sql, $parameters);
        $data = [];
        if (count($users) > 0) {
            for ($i = 0; $i < count($users); $i++) {
                $data[$i]['id'] = $users[$i]->getId();
                $data[$i]['name'] = $users[$i]->getLogin();
                $data[$i]['email'] = $users[$i]->getEmail();
                $data[$i]['is-admin'] = $users[$i]->getIsAdmin();
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

    private function getPizzaData($pizzas): array
    {
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
}
