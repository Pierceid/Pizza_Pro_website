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
        $data["isAdmin"] = $this->getIsAdmin($this->findUser());
        $data["pizzas"] = $this->getPizzas();
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
        $con = Connection::connect();
        $sql = "SELECT id FROM vaiicko_db.pizzas WHERE amount > 0";
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $discardedPizzas = $stmt->fetchAll(PDO::FETCH_COLUMN);

        $pizzas = Pizza::getAll();
        foreach ($pizzas as $pizza) {
            if (in_array($pizza->getId(), $discardedPizzas)) {
                $pizza->setAmount(0);
                $pizza->save();
            }
        }

        return $this->redirect($this->url("shop.index", ["userId" => $_GET['userId']]));
    }

    private function getPizzas(): array
    {
        $pizzas = Pizza::getAll(orderBy: `id ASC`);
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
            $data[$i]['cost'] = $orderedPizzas[$i]['cost'];
            $data[$i]['image-path'] = "public/images/pizzas/" . $orderedPizzas[$i]['imagePath'];
            $data[$i]['amount'] = $orderedPizzas[$i]['amount'];
        }
        return $data;
    }

    private function getUsers(): array
    {
        $users = User::getAll(orderBy: `id ASC`);
        $data[] = [];

        for ($i = 0; $i < count($users); $i++) {
            $data[$i]['id'] = $users[$i]->getId();
            $data[$i]['name'] = $users[$i]->getLogin();
            $data[$i]['email'] = $users[$i]->getEmail();
            $data[$i]['isAdmin'] = $users[$i]->getIsAdmin();
        }
        return $data;
    }

    private function getFilteredUsers(): array
    {
        $regex = $this->app->getRequest()->getValue('search-field') ?? '';
        //$users = User::getAll("login LIKE '%'?'%'", [$regex]);
        $filteredUsers = [];

        $users = User::getAll();
        foreach ($users as $user) {
            if (str_contains($user->getLogin(), $regex)) {
                $filteredUsers[] = $user;
            }
        }

        $data = [];
        if (count($filteredUsers) > 0) {
            for ($i = 0; $i < count($filteredUsers); $i++) {
                $data[$i]['id'] = $filteredUsers[$i]->getId();
                $data[$i]['name'] = $filteredUsers[$i]->getLogin();
                $data[$i]['email'] = $filteredUsers[$i]->getEmail();
                $data[$i]['isAdmin'] = $filteredUsers[$i]->getIsAdmin();
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
