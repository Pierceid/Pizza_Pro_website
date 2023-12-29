<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\Pizza;
use http\Header\Parser;

class PizzaController extends AControllerBase
{

    /**
     * @inheritDoc
     */
    public function index(): Response
    {
        return $this->html();
    }

    public function add(): Response
    {
        return $this->html();
    }

    public function addItem(): Response
    {
        $formData = $this->app->getRequest();
        $name = $formData->getValue("name");
        $description = $formData->getValue("description");
        $cost = $formData->getValue("cost");
        $imagePath = "/public/images/pizzas/neapolitan.png";

        if ($this->validateInputOnAdd($name, $description, $cost, $imagePath)) {
            $data = [];
            $data["message"] = "Item with successfully added!";

            $pizza = new Pizza();
            $pizza->setName($name);
            $pizza->setDescription($description);
            $pizza->setCost($cost);
            $pizza->setImagePath($imagePath);
            $pizza->save();
        } else {
            $data["message"] = "Invalid input values!";
        }

        return $this->redirect($this->url("shop.add", ["data" => $data]));
    }

    public function update(): Response
    {
        return $this->html();
    }

    /**
     * @throws \Exception
     */
    public function updateItem(): Response
    {
        $formData = $this->app->getRequest();
        $id = $formData->getValue("id");
        $name = $formData->getValue("name");
        $description = $formData->getValue("description");
        $cost = $formData->getValue("cost");
        $imagePath = "/public/images/pizzas/neapolitan.png";

        if ($this->validateInputOnUpdate($id, $name, $description, $cost, $imagePath)) {
            $data = [];
            $pizzaGetOne = Pizza::getOne($id);

            if (is_null($pizzaGetOne)) {
                $data["message"] = "Item with id (" . $id . ") doesnt exists!";
            } else {
                $data["message"] = "Item with id (" . $id . ") successfully updated!";
                $pizzaGetOne->setName($name);
                $pizzaGetOne->setDescription($description);
                $pizzaGetOne->setCost($cost);
                $pizzaGetOne->save();
            }
        } else {
            $data["message"] = "Invalid input values!";
        }

        return $this->redirect($this->url("shop.update", ["data" => $data]));
    }

    public function remove(): Response
    {
        return $this->html();
    }

    public function removeItem(): Response
    {
        $formData = $this->app->getRequest();
        $id = $formData->getValue("id");
        $pizzaGetOne = Pizza::getOne($id);

        if ($this->validateInputOnRemove($id)) {
            $data = [];
            if (is_null($pizzaGetOne)) {
                $data["message"] = "Item with id (" . $id . ") doesnt exist!";
            } else {
                $data["message"] = "Item with id (" . $id . ") successfully removed!";
                $pizzaGetOne->delete();
            }
        } else {
            $data["message"] = "Invalid input values!";
        }

        return $this->redirect($this->url("shop.remove", ["data" => $data]));
    }

    public function validateInputOnAdd($name, $description, $cost, $imagePath): bool
    {
        return !empty($name) && strlen($name) < 50 &&
            !empty($description) && strlen($description) < 300 &&
            !empty($cost) && is_int((int)$cost) &&
            !empty($imagePath) && strlen($imagePath) < 300;
    }

    public function validateInputOnUpdate($id, $name, $description, $cost, $imagePath): bool
    {
        return !empty($id) && is_int((int)$id) &&
            !empty($name) && strlen($name) < 50 &&
            !empty($description) && strlen($description) < 300 &&
            !empty($cost) && is_int((int)$cost) &&
            !empty($imagePath) && strlen($imagePath) < 300;
    }

    public function validateInputOnRemove($id): bool
    {
        return is_int((int)$id);
    }

    // button + a - na CRUD s pizza kartami
}