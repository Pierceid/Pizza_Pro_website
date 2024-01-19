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

    public function cart(): Response
    {
        $data = $this->getOrderedPizzas();
        return $this->html($data);
    }

    public function database(): Response
    {
        $data["admin"] = $this->getIsAdmin();
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
        /*
        $con = Connection::connect();
        $sql = "SELECT id, login, email, isAdmin FROM vaiicko_db.users WHERE login LIKE ? ORDER BY id";
        $stmt = $con->prepare($sql);
        $stmt->execute();

        $users = [];
        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $users[] = $result;
        }
        */

        $users = User::getAll(whereClause: `login LIKE %$regex%`);
        $filteredUsers = [];
        foreach ($users as $user) {
            if (str_contains($user->getLogin(), $regex)) {
                $filteredUsers[] = $user;
            }
        }

        $data = [];
        if (count($filteredUsers) > 0) {
            for ($i = 0; $i < count($filteredUsers); $i++) {
                $data[] = "<tr>
                            <td>" . $filteredUsers[$i]->getId() . "</td>
                            <td>" . $filteredUsers[$i]->getLogin() . "</td>
                            <td>" . $filteredUsers[$i]->getEmail() . "</td>
                            <td>" . $filteredUsers[$i]->getIsAdmin() . "</td>
                          </tr>";
            }
        } else {
            $data[] = "<tr><td>0 results found</td></tr>";
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
