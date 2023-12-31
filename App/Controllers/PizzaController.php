<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\Pizza;

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
        $imagePath = "/public/images/pizzas/" . str_replace(' ', '-', strtolower($name)) . ".png";

        if ($this->validateInput($name, $description, $cost)) {
            $pizza = new Pizza();
            $pizza->setName($name);
            $pizza->setDescription($description);
            $pizza->setCost($cost);
            $pizza->setImagePath($imagePath);
            $pizza->save();

            return $this->redirect($this->url("shop.success"));
        }

        return $this->redirect($this->url("shop.fail"));
    }

    public function update(): Response
    {
        return $this->html();
    }

    public function updateItem(): Response
    {
        $formData = $this->app->getRequest();
        $id = $this->request()->getValue('id');
        $name = $formData->getValue("name");
        $description = $formData->getValue("description");
        $cost = $formData->getValue("cost");
        $imagePath = "/public/images/pizzas/" . str_replace(' ', '-', strtolower($name)) . ".png";

        if ($this->validateInput($name, $description, $cost)) {
            $pizzaGetOne = Pizza::getOne($id);

            if (!is_null($pizzaGetOne)) {
                $pizzaGetOne->setName($name);
                $pizzaGetOne->setDescription($description);
                $pizzaGetOne->setCost($cost);
                $pizzaGetOne->setImagePath($imagePath);
                $pizzaGetOne->save();

                return $this->redirect($this->url("shop.success"));
            }
        }

        return $this->redirect($this->url("shop.fail"));
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

        if (!is_null($pizzaGetOne)) {
            $pizzaGetOne->delete();

            return $this->redirect($this->url("shop.success"));
        }

        return $this->redirect($this->url("shop.fail"));
    }

    public function validateInput($name, $description, $cost): bool
    {
        return !empty($name) && strlen($name) < 200 &&
            !empty($description) && strlen($description) < 200 &&
            is_numeric($cost) && strlen((string)$cost) < 200;
    }

    public function fail(): Response
    {
        $data["message"] = "Failed to complete the requested action!";
        return $this->html($data);
    }

    public function success(): Response
    {
        $data["message"] = "Action has been completed successfully!";
        return $this->html($data);
    }
}
