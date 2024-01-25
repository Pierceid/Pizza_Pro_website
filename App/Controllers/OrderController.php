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

    public function orderManagement(): Response
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
        $locationId = '';

        if ($this->validateInput($street, $city, $zip)) {
            $location = new Location();
            $location->setStreet($street);
            $location->setCity($city);
            $location->setZip($zip);

            $locations = Location::getAll();
            $existingLocation = array_filter($locations, function ($location) use ($street, $city, $zip) {
                return $location->getStreet() == $street && $location->getCity() == $city && $location->getZip() == $zip;
            });

            if (empty($existingLocation)) {
                $location->save();
                $locationId = $location->getId();
            } else {
                foreach ($locations as $loc) {
                    if ($loc->getStreet() == $street && $loc->getCity() == $city && $loc->getZip() == $zip) {
                        $locationId = $loc->getId();
                        break;
                    }
                }
            }

            $message = "Location has been successfully chosen!";
            $data = ["operation" => "order", "location-id" => $locationId, "purchase" => $purchase, "message" => $message];
            return $this->redirect($this->url("order.orderManagement", $data));
        }

        $data = ["operation" => "choose", "street" => $street, "city" => $city, "zip" => $zip, "purchase" => $purchase, "message" => $message];
        return $this->redirect($this->url("order.orderManagement", $data));
    }

    public function createOrder(): Response
    {
        $formData = $this->app->getRequest();
        $locationId = $formData->getValue("location-id");
        $purchase = $formData->getValue("order-cost");
        $userId = $this->findUser()->getId();
        $operation = "order";
        $message = "Failed to place your order!";

        if ($purchase > 0) {
            $order = new Order();
            $order->setUser($userId);
            $order->setLocation($locationId);
            $order->setPurchase($purchase);
            $order->setTime(date("d.m.Y [h:i A]"));
            $order->save();

            $operation = "ok";
            $message = "Order has been placed successfully!";
        }

        $data = ["operation" => $operation, "location-id" => $locationId, "message" => $message];
        return $this->redirect($this->url("order.orderManagement", $data));
    }

    private function refreshPizzas(): void
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
    }

    public function discardOrder(): Response
    {
        $this->refreshPizzas();
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