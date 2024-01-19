<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\DB\Connection;
use App\Core\Responses\Response;
use App\Models\Order;
use App\Models\Pizza;
use App\Models\Location;
use App\Models\User;
use PDO;

class OrderController extends AControllerBase
{
    /**
     * @inheritDoc
     */
    public function index(): Response
    {
        return $this->html();
    }

    public function createLocation(): Response
    {
        $formData = $this->app->getRequest();
        $purchase = $formData->getValue("order-cost");
        $street = $formData->getValue("street");
        $city = $formData->getValue("city");
        $zip = $formData->getValue("zip");
        $message = "Failed to choose a location!";

        if ($this->validateInput($street, $city, $zip)) {
            $place = new Location();
            $place->setStreet($street);
            $place->setCity($city);
            $place->setZip($zip);
            $place->save();

            $message = "Location has been successfully chosen!";
            $data = ["operation" => "order", "message" => $message, "id" => $place->getId(), "purchase" => $purchase];
            return $this->redirect($this->url("shop.order", $data));
        }

        $data = ["operation" => "choose", "message" => $message, "street" => $street, "city" => $city, "zip" => $zip, "purchase" => $purchase];
        return $this->redirect($this->url("shop.cartManagement", $data));
    }

    public function createOrder(): Response
    {
        $formData = $this->app->getRequest();
        $id = $formData->getValue("location-id");
        $purchase = $formData->getValue("order-cost");
        $user = $this->findUser();
        $operation = "order";
        $message = "Failed to place your order!";

        if ($purchase > 0) {
            $order = new Order();
            $order->setName($user->getLogin());
            $order->setEmail($user->getEmail());
            $order->setTime(date("d.m.Y [h:i A]"));
            $order->setPlace($id);
            $order->setPurchase($purchase);
            $order->save();

            $operation = "ok";
            $message = "Order has been placed successfully!";
        }

        $data = ["operation" => $operation, "message" => $message];
        return $this->redirect($this->url("shop.order", $data));
    }

    public function discardOrder(): Response
    {
        $purchase = $this->app->getRequest()->getValue("order-cost");
        $message = "Failed to discard the order!";

        if ($purchase > 0) {
            $this->discardPizzas();
            $purchase = 0;
            $message = "Order has been successfully discarded!";
        }

        $data = ["message" => $message, "purchase" => $purchase];
        return $this->redirect($this->url("shop.cart", $data));
    }

    public function discardPizzas(): Response
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

        return $this->redirect($this->url("shop.cart"));
    }

    private function validateInput($street, $city, $zip): bool
    {
        return !empty($street) && strlen($street) < 200 &&
            !empty($city) && strlen($city) < 200 &&
            is_numeric($zip) && strlen((string)$zip) < 11;
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
}