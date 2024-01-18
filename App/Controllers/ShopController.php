<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\DB\Connection;
use App\Core\Responses\Response;
use App\Models\Pizza;
use App\Models\User;
use PDO;

class ShopController extends AControllerBase
{
    /**
     * @inheritDoc
     */
    public function index(): Response
    {
        $data["isAdmin"] = $this->getIsAdmin();
        $data["pizzas"] = $this->getPizzas();
        return $this->html($data);
    }

    public function user(): Response
    {
        return $this->html();
    }

    public function profile(): Response
    {
        $user = $this->findUser();
        $data = [
            "name" => $user->getLogin(),
            "email" => $user->getEmail(),
            "password" => $user->getPassword(),
            "isAdmin" => $user->getIsAdmin(),
            "imagePath" => $user->getProfileImage()
        ];
        return $this->html($data);
    }

    public function database(): Response
    {
        $data["admin"] = $this->getIsAdmin();
        $data["users"] = $this->getUsers();
        return $this->html($data);
    }

    public function feedback(): Response
    {
        return $this->html();
    }

    public function cart(): Response
    {
        $data = $this->getOrderedPizzas();
        return $this->html($data);
    }

    public function add(): Response
    {
        return $this->html();
    }

    public function insert(): Response
    {
        return $this->html();
    }

    public function update(): Response
    {
        return $this->html();
    }

    public function delete(): Response
    {
        return $this->html();
    }

    private function getPizzas(): array
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

    private function getOrderedPizzas(): array
    {
        $con = Connection::connect();
        $sql = "SELECT * FROM vaiicko_db.pizzas WHERE amount > 0";
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $orderedPizzas = [];
        $data[] = [];

        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $orderedPizzas[] = $result;
        }

        for ($i = 0; $i < count($orderedPizzas); $i++) {
            $data[$i]['id'] = $orderedPizzas[$i]['id'];
            $data[$i]['name'] = $orderedPizzas[$i]['name'];
            $data[$i]['description'] = $orderedPizzas[$i]['description'];
            $data[$i]['cost'] = number_format($orderedPizzas[$i]['cost'], 2);
            $data[$i]['image-path'] = "public/images/pizzas/" . $orderedPizzas[$i]['imagePath'];
            $data[$i]['amount'] = $orderedPizzas[$i]['amount'];
        }
        return $data;
    }

    private function getUsers(): array
    {
        $users = User::getAll(orderBy: '`id` asc');
        $data[] = [];

        for ($i = 0; $i < count($users); $i++) {
            $data[$i]['id'] = $users[$i]->getId();
            $data[$i]['name'] = $users[$i]->getLogin();
            $data[$i]['email'] = $users[$i]->getEmail();
            $data[$i]['isAdmin'] = $users[$i]->getIsAdmin();
        }
        return $data;
    }

    private function findUser(): ?User
    {
        $users = User::getAll();
        foreach ($users as $user) {
            if ($user->getLogin() == $this->app->getAuth()->getLoggedUserName()) {
                return $user;
            }
        }
        return null;
    }

    private function getIsAdmin(): int
    {
        $user = $this->findUser();
        return $user ? $user->getIsAdmin() : 0;
    }
}
