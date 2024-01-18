<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\Order;
use App\Models\Pizza;
use App\Models\Place;
use App\Models\User;

class OrderController extends AControllerBase
{

    /**
     * @inheritDoc
     */
    public function index(): Response
    {
        return $this->html();
    }

    public function createOrder(): Response
    {
        $formData = $this->app->getRequest();
        $street = $formData->getValue("street");
        $city = $formData->getValue("city");
        $zip = $formData->getValue("zip");
        $purchase = $formData->getValue("order-cost");
        $user = $this->findUser();
        $message = "Failed to place the order!";

        if ($this->validateInput($street, $city, $zip)) {
            $place = new Place();
            $place->setStreet($street);
            $place->setCity($city);
            $place->setZip($zip);
            $place->save();

            $order = new Order();
            $order->setName($user->getLogin());
            $order->setEmail($user->getEmail());
            $order->setTime(date("d.m.Y [h:i A]"));
            $order->setPlace($place->getId());
            $order->setPurchase($purchase);
            $order->save();

            $message = "Order has been successfully placed!";
        }

        $data = ["operation" => "order", "message" => $message, "street" => $street, "city" => $city, "zip" => $zip, "purchase" => $purchase];
        return $this->redirect($this->url("shop.cartManagement", $data));
    }

    public function discardOrder(): Response
    {
        $purchase = $this->app->getRequest()->getValue("order-cost");
        $message = "Failed to discard the order!";

        $pizzas = Pizza::getAll();
        foreach ($pizzas as $pizza) {
            $pizza->setAmount(0);
            $pizza->save();
        }
        if ($purchase > 0) {
            $purchase = 0;
            $message = "Order has been successfully discarded!";
        }

        $data = ["operation" => "discard", "message" => $message, "purchase" => $purchase];
        return $this->redirect($this->url("shop.cartManagement", $data));
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